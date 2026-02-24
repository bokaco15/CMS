<?php

namespace App\Repositories\Admin;
use App\Models\User;
use App\Traits\AvatarPhoto;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UserRepository
{
    use AvatarPhoto;
    public function datatable():JsonResponse
    {
        $model = User::query();

        $datatable = DataTables::of($model);

        $datatable->editColumn('is_banned', function ($row) {
            if ($row->is_banned) {
                return '<span class="text-danger font-weight-bold">Banned</span>';
            }
            return '<span class="text-success font-weight-bold">Not Banned</span>';
        }) -> editColumn('avatar', function ($row) {
            if ($row->avatar) {
                return '<img src="' . $row->avatar . '" alt="Avatar" width="50" height="50" class="rounded-circle">';
            }
        }) -> editColumn('actions', function ($row) {
            return view('admin.user.partials.buttons', compact('row'));
        }) -> editColumn('created_at', function ($row) {
            return '<p>'.$row->created_at->format('Y-m-d H:i:s').'</p>';
        })
            ->rawColumns(['is_banned', 'avatar', 'action', 'created_at']);

        return $datatable->toJson();
    }

    public function createUser($request, $avatar): User
    {
        $slug = $request->slug;
        $counter = 1;
        while (User::where('slug', $slug)->exists()) {
            $slug = "{$slug}-{$counter}";
            $counter++;
        }
        $user = User::create([
            'name' => $request->name,
            'slug' => $slug,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make("bokaco123"),
        ]);

        if($avatar) {
            $avatarAddPath = $this->photo("{$user->id}.webp", $request->file('avatar'));
            if($avatarAddPath){
                $user->avatar = $avatarAddPath;
                $user->save();
            }
        }
        return $user;
    }

    public function updateUser($request, $user, $avatar): User
    {
        $slug = $request->slug;
        $counter = 1;
        while (User::where('slug', $slug)->exists()) {
            $slug = "{$slug}-{$counter}";
            $counter++;
        }

        $user->update([
            'name' => $request->name,
            'slug' => $slug,
            'phone' => $request->phone,
        ]);

        if($avatar) {
            $updateAvatarPath = $this->photo("{$user->id}.webp", $request->file('avatar'));
            if ($updateAvatarPath) {
                $user->avatar = $updateAvatarPath;
                $user->save();
            }
        }

        return $user;
    }

    public function deleteUserAvatar($request, $user): JsonResponse
    {
        if($user->avatar){
            if(Storage::disk('public')->exists('images/avatars/'."{$user->id}.webp")){
                Storage::disk('public')->delete('images/avatars/'."{$user->id}.webp");
                $user->avatar = null;
                $user->save();

                return response()->json([
                    'message' => "User <b>{$user->name}</b> avatar deleted successfully."
                ], 200);
            }
        }
        return response()->json([
            'message' => "Avatar not found."
        ], 400);
    }

}
