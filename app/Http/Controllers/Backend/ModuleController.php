<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleStoreRequest;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('index-module'); //authorize this user to access/give access to admin dashboard;
        $modules = Module::select(['id', 'module_name', 'module_slug', 'updated_at'])->latest()->get();
        return view('admin.pages.module.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-module'); //authorize this user to access/give access to admin dashboard;
        return view('admin.pages.module.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModuleStoreRequest $request)
    {
        Gate::authorize('create-module'); //authorize this user to access/give access to admin dashboard;
        Module::updateOrCreate([
            'module_name' => $request->module_name,
            'module_slug' => Str::slug($request->module_name),
        ]);

        Toastr::success('Module Created Successfully.');
        return redirect()->route('module.index');
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
        Gate::authorize('edit-module'); //authorize this user to access/give access to admin dashboard;
        $module = Module::find($id);
        return view('admin.pages.module.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModuleStoreRequest $request, string $id)
    {
        Gate::authorize('edit-module'); //authorize this user to access/give access to admin dashboard;
        $module = Module::find($id);
        $module->update([
            'module_name' => $request->module_name,
            'module_slug' => Str::slug($request->module_name),
        ]);

        Toastr::success('Module Updated Successfully.');
        return redirect()->route('module.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-module'); //authorize this user to access/give access to admin dashboard;
        $module = Module::find($id);
        $module->delete();

        Toastr::success('Module Deleted Successfully.');
        return redirect()->route('module.index');
    }
}
