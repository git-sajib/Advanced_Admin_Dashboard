<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
}
