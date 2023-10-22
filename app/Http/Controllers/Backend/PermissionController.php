<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::with(['module:id,module_name,module_slug'])->select(['id', 'module_id', 'permission_name', 'permission_slug', 'updated_at'])->latest()->paginate();
        // return $permissions;
        return view('admin.pages.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::select(['id', 'module_name'])->get();
        return view('admin.pages.permission.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionStoreRequest $request)
    {
        Permission::updateOrCreate([
            'module_id' => $request->module_id,
            'permission_name' => $request->permission_name,
            'permission_slug' => Str::slug($request->permission_name),
        ]);

        Toastr::success('Permission Created Successfully.');
        return redirect()->route('permission.index');
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
}
