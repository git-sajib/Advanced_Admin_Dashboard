<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePasswordChangeRequest;
use App\Http\Requests\ProfileStoreRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Image;

class ProfileController extends Controller
{
    public function getUpdateProfile()
    {
        Gate::authorize('profile-update');
        $authUser = Auth::user();
        return view('admin.pages.profile.update-profile', compact('authUser'));
    }

    public function updateProfile(ProfileStoreRequest $request)
    {
        Gate::authorize('profile-update');
        $user = User::whereEmail($request->email)->first();
        $this->image_upload($request, $user->id);

        Toastr::success('Profile Updated Successfully!');
        return back();
    }

    public function getUpdatePassword()
    {
        Gate::authorize('password-update');
        return view('admin.pages.profile.update-password');
    }

    public function updatePassword(ProfilePasswordChangeRequest $request)
    {
        Gate::authorize('password-update');
        $user = Auth::user();
        $hashedPassword = $user->password;
        //existing password == request password
        if (Hash::check($request->old_password, $hashedPassword)) {
            //new password == old password
            if (!Hash::check($request->password, $hashedPassword)) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);

                Auth::logout();
                Toastr::success("Password Updated Successfully");
                return redirect()->route('login');
            } else {
                Toastr::error("New password can't be the old password");
                return back();
            }
        } else {
            Toastr::error("Credentials didn't match");
            return back();
        }
    }

    public function image_upload($request, $user_id)
    {
        //check if image uploaded
        if ($request->hasFile('user_image')) {
            $user = User::find($user_id);

            // check if already exist previous image
            if ($user->user_image != null) {
                //delete old photo
                $old_photo_path = 'public/uploads/profile_images/' . $user->user_image;
                unlink(base_path($old_photo_path));
            }

            $photo_location = 'public/uploads/profile_images/';
            $uploaded_photo = $request->file('user_image');
            $new_photo_name = $user_id . '.' . $uploaded_photo->getClientOriginalExtension(); //Ex: 1.jpg
            $new_photo_location = $photo_location . $new_photo_name; //Ex: public/uploads/profile_images/1.jpg

            //save image
            Image::make($uploaded_photo)->resize(600, 600)->save(base_path($new_photo_location));
            $user->update([
                'user_image' => $new_photo_name,
            ]);
        };
    }
}
