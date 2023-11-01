<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppearanceUpdateRequest;
use App\Http\Requests\GeneralSettingUpdateRequest;
use App\Models\Setting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function general()
    {
        return view('admin.pages.settings.general');
    }

    public function generalUpdate(GeneralSettingUpdateRequest $request)
    {
        Setting::updateOrCreate(
            ['name' => 'site_title'],
            ['value' => $request->site_title],
        );
        Setting::updateOrCreate(
            ['name' => 'site_address'],
            ['value' => $request->site_address,]
        );
        Setting::updateOrCreate(
            ['name' => 'site_phone'],
            ['value' => $request->site_phone],
        );
        Setting::updateOrCreate(
            ['name' => 'site_facebook_link'],
            ['value' => $request->site_facebook_link],
        );
        Setting::updateOrCreate(
            ['name' => 'site_instagram_link'],
            ['value' => $request->site_instagram_link],
        );
        Setting::updateOrCreate(
            ['name' => 'site_linkedin_link'],
            ['value' => $request->site_linkedin_link],
        );
        Setting::updateOrCreate(
            ['name' => 'site_youtube_link'],
            ['value' => $request->site_youtube_link],
        );
        Setting::updateOrCreate(
            ['name' => 'site_description'],
            ['value' => $request->site_description],
        );

        Toastr::success('Setting Updated Successfully!');
        return back();
    }

    public function appearance()
    {
        return view('admin.pages.settings.appearance');
    }

    public function appearanceUpdate(AppearanceUpdateRequest $request)
    {
        Setting::updateOrCreate(
            ['name' => 'bg_color'],
            ['value' => $request->bg_color],
        );

        if ($request->hasFile('logo_image')) {
            if (setting('logo_image') != null) {
                $this->deleteOldFile(setting('logo_image'));
            }
            Setting::updateOrCreate(
                ['name' => 'logo_image'],
                ['value' => Storage::putFileAs('public', $request->file('logo_image'), 'logo_image.jpg')],
            );
        }

        if ($request->hasFile('favicon_image')) {
            if (setting('favicon_image') != null) {
                $this->deleteOldFile(setting('favicon_image'));
            }
            Setting::updateOrCreate(
                ['name' => 'favicon_image'],
                ['value' => Storage::putFileAs('public', $request->file('favicon_image'), 'favicon_image.jpg')],
            );
        }

        Toastr::success('Setting Updated Successfully!');
        return back();
    }

    private function deleteOldFile($path)
    {
        Storage::disk('public')->delete($path);
    }
}
