<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'name' => 'splash_image',
                'ar_value' => 'image',
                'en_value' => 'image',
                'type' => 'file',
                'page' => 'صفحة الاسبلاش',
                'ar_title' => 'صورة الاسبلاش',
                'en_title' => 'splash image',
                'slug' => 'splash_image'
            ], [
                'name' => 'device_type',
                'ar_value' => 'android',
                'en_value' => 'android',
                'type' => 'text',
                'page' => 'صفحة الاسبلاش',
                'ar_title' => 'نوع الجهاز',
                'en_title' => 'device_type',
                'slug' => 'device_type'
            ], [
                'name' => 'country',
                'ar_value' => 'الاردن',
                'en_value' => 'Jordan',
                'type' => 'text',
                'page' => 'صفحة الاسبلاش',
                'ar_title' => 'البلد',
                'en_title' => 'country',
                'slug' => 'country'
            ],


        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
