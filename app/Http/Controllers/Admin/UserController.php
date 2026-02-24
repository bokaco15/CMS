<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\AddUserRequest;
use App\Http\Requests\Admin\Users\DeleteUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserStatusRequest;
use App\Models\User;
use App\Repositories\Admin\UserRepository;
use App\Traits\AvatarPhoto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    use AvatarPhoto;

    public function __construct(protected UserRepository $userRepository){}

    public function index():View
    {
        $users = User::all()->sortByDesc('created_at');
        return view('admin.user._index', compact('users'));
    }

    public function dataTableUsers(): JsonResponse
    {
        return $this->userRepository->dataTable();
    }

    public function delete(DeleteUserRequest $request): JsonResponse
    {
        $user = User::findOrFail($request->id);
        $user->delete();

        return response()->json([
            'message' => "User {$user->name} deleted successfully."
        ]);
    }

    public function updateStatus(UpdateUserStatusRequest $request): JsonResponse
    {
        $user = User::findOrFail($request->id);
        $user->is_banned = $request->is_banned;
        $user->save();
        return response()->json(['message' => "User {$user->name} status updated successfully."]);
    }

    public function add(AddUserRequest $request): RedirectResponse
    {
        $user = $this->userRepository->createUser($request, $request->file('avatar'));
        return redirect()->route('admin.addUser')->with('success', "User <b>{$user->name}</b> created successfully.");
    }

    public function editUser(User $user, $slug): View
    {
        return view('admin.user.edit', compact('user'));
    }

    public function updateUser(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user = $this->userRepository->updateUser($request, $user, $request->file('avatar'));
        $user->refresh();
        return redirect()->back()->with('success', "User <b>{$user->name}</b> updated successfully.");
    }

    public function deleteAvatar(Request $request): JsonResponse
    {
        $user = User::findOrFail($request->id);
        return $this->userRepository->deleteUserAvatar($request, $user);
    }

}
