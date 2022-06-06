<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UpdatePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'Admins'=> 'التعامل مع المديرين',
            'Roles' => 'التعامل مع الصلاحيات والمناصب',
            'Users'=> 'التعامل مع الاعضاء',
            'Banners'=> 'التعامل مع البانرات',
            'Categories'=> 'التعامل مع الاقسام ',
            'Services'=> 'التعامل مع الخدمات ',
            'Providers'=> 'التعامل مع مقدمى الخدمات ',
            'Carts'=> 'التعامل مع الطلبات  ',
            'Reports'=> 'التعامل مع البلاغات  ',
            'Settings'=> 'التعامل مع الاعدادات  ',
            'Notifications'=> 'التعامل مع الاشعارات  ',
            'Countries'=> 'التعامل مع  المدن  ',
            'Blogs'=> 'التعامل مع  الاخبار  ',

        ];

        foreach ($permissions as $key => $permission) {
            Permission::where('name', $key)->update(['ar_name' => $permission]);
        }
    }
}
