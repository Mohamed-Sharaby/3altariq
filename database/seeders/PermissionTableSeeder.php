<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Admin::updateOrCreate(['email'=>'admin@admin.com'],[
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '123456',
            'password' => '123456',
            'is_active' => 1,
        ]);
        $permissions = [
            'Admins',
            'Roles',
            'Users',
            'Banners',
            'Categories',
            'Services',
            'Providers',
            'Carts',
            'Reports',
            'Settings',
            'Notifications',
            'Countries',
            'Blogs',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission],['name' => $permission, 'guard_name' => 'admin']);
        }

        $role = Role::updateOrCreate(['name'=> 'Super Admin'],['name' => 'Super Admin', 'guard_name' => 'admin']);
        $role->syncPermissions($permissions);
        $user->assignRole('Super Admin');
    }
}
