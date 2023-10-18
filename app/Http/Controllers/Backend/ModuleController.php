<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleStoreRequest;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::select(['id', 'module_name', 'module_slug', 'updated_at'])->latest()->get();
        return view('admin.pages.module.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.module.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModuleStoreRequest $request)
    {
        Module::updateOrCreate([
            'module_name' => $request->module_name,
            'module_slug' => Str::slug($request->module_name),
        ]);

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
        dd($id);
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
}
