<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use App\Models\User;
use App\Traits\AvatarPhoto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;


class AdminController extends Controller
{
    use AvatarPhoto;
    public function index():View
    {
        return view('admin.index._index');
    }

    public function editPassword():View
    {
        return view('admin.profile.editPassword');
    }

    public function updatePassword(UpdatePasswordRequest $request, User $user): RedirectResponse
    {
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('admin.profile.index')->with('success', 'You have successfully updated your password');
    }

    public function deleteAvatar(Request $request): JsonResponse
    {
        $user = User::findOrFail($request->id);
        if(Storage::disk('public')->exists("images/avatars/{$user->id}.webp")) {
            Storage::disk('public')->delete("images/avatars/{$user->id}.webp");
            $user->avatar = null;
            $user->save();
            return response()->json([
                'message' => 'Avatar deleted successfully'
            ], 200);
        }
        return response()->json([
            'message' => 'Avatar cannot be deleted'
        ], 404);
    }

    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $user = User::findOrFail($request->id);
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        $avatarUpdatePath = $this->photo("{$user->id}.webp", $request->file('avatar'));
        if($avatarUpdatePath) {
            $user->avatar = $avatarUpdatePath;
            $user->save();
        }

        return response()->json([
            'message' => 'Profile updated successfully.',
            'userName' => $user->name,
            'avatar_url' => $user->avatar
        ]);

    }

}
