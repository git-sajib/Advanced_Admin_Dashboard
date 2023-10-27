<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getUpdateProfile()
    {
        $authUser = Auth::user();
        return view('admin.pages.profile.update-profile', compact('authUser'));
    }

    public function updateProfile(Request $request)
    {
        dd($request->all());
    }
}
