<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageStroeRequest;
use App\Http\Requests\PageUpdateRequest;
use App\Models\Page;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::select(['id', 'page_title', 'page_slug', 'meta_title', 'meta_keywords', 'is_active', 'updated_at'])->paginate();
        return view('admin.pages.page-builder.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.page-builder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageStoreRequest $request)
    {
        $page = Page::updateOrCreate([
            'page_title' => $request->page_title,
            'page_slug' => $request->page_slug ?? Str::slug($request->page_title),
            'page_short' => $request->page_short,
            'page_long' => $request->page_long,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'is_active' => true,
        ]);

        $this->image_upload($request, $page->id);

        Toastr::success('Page Created Successfully');
        return redirect()->route('page.index');
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
        $page = Page::find($id);
        return view('admin.pages.page-builder.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateRequest $request, string $id)
    {
        $page = Page::find($id);
        $page->update([
            'page_title' => $request->page_title,
            'page_slug' => $request->page_slug ?? Str::slug($request->page_title),
            'page_short' => $request->page_short,
            'page_long' => $request->page_long,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'is_active' => true,
        ]);

        $this->image_upload($request, $page->id);

        Toastr::success('Page Updated Successfully');
        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::find($id);
        //delete old photo
        if ($page->page_image != null) {
            $old_photo_path = 'public/uploads/page_images/' . $page->page_image;
            unlink(base_path($old_photo_path));
        }
        $page->delete();
        Toastr::success('Page Deleted Successfully.');
        return redirect()->route('page.index');
    }

    function checkActive($page_id)
    {
        $page = Page::find($page_id);
        // toggle the is_active
        if ($page->is_active == 1) {
            $page->is_active = 0;
        } else {
            $page->is_active = 1;
        }
        $page->update();
        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }

    public function image_upload($request, $page_id)
    {
        //check if image uploaded
        if ($request->hasFile('page_image')) {
            $page = Page::find($page_id);

            // check if already exist previous image
            if ($page->page_image != null) {
                //delete old photo
                $old_photo_path = 'public/uploads/page_images/' . $page->page_image;
                unlink(base_path($old_photo_path));
            }

            $photo_location = 'public/uploads/page_images/';
            $uploaded_photo = $request->file('page_image');
            $new_photo_name = $page_id . '.' . $uploaded_photo->getClientOriginalExtension(); //Ex: 1.jpg
            $new_photo_location = $photo_location . $new_photo_name; //Ex: public/uploads/page_images/1.jpg

            //save image
            Image::make($uploaded_photo)->save(base_path($new_photo_location));
            $page->update([
                'page_image' => $new_photo_name,
            ]);
        };
    }
}
