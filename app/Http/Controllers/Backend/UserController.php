<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-user'); //authorize this user to access/give access to admin dashboard;
        $users = User::with(['role:id,role_name,role_slug'])
            ->select(['id', 'role_id', 'name', 'email', 'user_image', 'is_active', 'updated_at'])
            ->latest()
            ->paginate();
        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-user'); //authorize this user to access/give access to admin dashboard;
        $roles = Role::select('id', 'role_name')->get();
        return view('admin.pages.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        Gate::authorize('create-user'); //authorize this user to access/give access to admin dashboard;
        User::updateOrCreate([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
        ]);

        Toastr::success('User Created Successfully.');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('edit-user'); //authorize this user to access/give access to admin dashboard;
        $user = User::find($id);
        $roles = Role::select('id', 'role_name')->get();
        return view('admin.pages.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        Gate::authorize('edit-user'); //authorize this user to access/give access to admin dashboard;
        $user = User::find($id);
        $user->update([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Toastr::success('User Updated Successfully.');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-user'); //authorize this user to access/give access to admin dashboard;
        $user = User::find($id);
        //delete old photo
        if ($user->user_image != null) {
            $old_photo_path = 'public/uploads/profile_images/' . $user->user_image;
            unlink(base_path($old_photo_path));
        }
        $user->delete();
        Toastr::success('User Deleted Successfully.');
        return redirect()->route('users.index');
    }

    public function checkActive($user_id)
    {
        $user = User::find($user_id);
        // toggle the is_active
        if ($user->is_active == 1) {
            $user->is_active = 0;
        } else {
            $user->is_active = 1;
        }
        $user->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
