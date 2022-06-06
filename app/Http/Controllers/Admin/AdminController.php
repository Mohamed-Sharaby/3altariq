<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Admins');
    }

    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        $admins = Admin::all();
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $superAdminRole = Role::whereName('Super Admin')->first();
        $roles = Role::where('id','!=',$superAdminRole->id)->where('is_active', '1')->get()->pluck('name','id');
        return view('dashboard.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     */
    public function store(AdminRequest $request)
    {
        $validator = $request->validated();
        $validator['is_active'] = 1;

        $roles = $validator['roles'] ?? [];
        unset($validator['roles']);

        $admin = Admin::create($validator);
        $admin->syncRoles($roles);
        return redirect(route('admin.admins.index'))->with('success', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::get()->pluck('name','id');
        return view('dashboard.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return
     */
    public function update(AdminRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $validator = $request->validated();

        $roles = $validator['roles'] ?? [];
        unset($validator['roles']);

        $admin->syncRoles($roles);
        $admin->update($validator);
        return redirect(route('admin.admins.index'))->with('success', 'تم التعديل بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        if (auth()->user()->id == $admin->id) {
            return redirect(route('admin.admins.index'))->with('error', 'عفوا ... لا يمكنك حذف العضوية الخاصة بك');
        }

        $admin->delete();
        return 'Done';
    }
}
