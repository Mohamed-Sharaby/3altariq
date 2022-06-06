<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        $permissions = Permission::all();
        //$permission = $allPermissions->except([1]);
        return view('dashboard.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    public function store(RoleRequest $request)
    {
        $validator = $request->validated();
        $role = Role::create(['name' => $validator['name']]);
        if ($validator['permission']) {
            $role->syncPermissions($validator['permission']);
        }
        return redirect(route('admin.roles.index'))->with('success', __(' تم الاضافة بنجاح'));
    }


    public function edit(Role $role)
    {
        $permission = Permission::all();
        //$permission = $allPermissions->except([1, 2, 3, 4]);

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('dashboard.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return
     */
    public function update(RoleRequest $request, Role $role)
    {
        $validator = $request->validated();

        $role->name = $validator['name'];
        $role->save();

        $permissions = $validator['permission'] ?? [];
        unset($validator['permission']);

        $role->syncPermissions($permissions);
        $role->update($validator);

        return redirect(route('admin.roles.index'))->with('success', __(' تم التعديل بنجاح'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return 'Done';
    }

    public function active($id)
    {
        $baseClass = 'Spatie\Permission\Models\Role';
        $model = $baseClass::findOrFail($id);
        $model->update(['is_active' => !$model->is_active]);

// عند تعطيل منصب معين يتم تعطيل كل المديرين الذين ينتمون لنفس هذا المنصب بشكل تلقائى والعكس
        $admins = Admin::all();
        foreach ($admins as $admin) {
            if ($admin->hasRole($model)) {
                $admin->update(['is_active' => $model->is_active]);
            }
        }

        return back()->with('success', __('تم التعديل بنجاح'));
    }
}
