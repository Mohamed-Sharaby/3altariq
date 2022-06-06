<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'ar_title' => NULL,
                'ar_value' => '0',
                'created_at' => '2021-07-01 16:06:18',
                'en_title' => NULL,
                'en_value' => '0',
                'id' => 4,
                'name' => 'provider_counter',
                'page' => NULL,
                'slug' => NULL,
                'type' => 'hidden',
                'updated_at' => '2021-07-01 16:06:18',
            ),
            1 => 
            array (
                'ar_title' => NULL,
                'ar_value' => '0',
                'created_at' => '2021-07-01 16:06:18',
                'en_title' => NULL,
                'en_value' => '0',
                'id' => 5,
                'name' => 'user_counter',
                'page' => NULL,
                'slug' => NULL,
                'type' => 'hidden',
                'updated_at' => '2021-07-01 16:06:18',
            ),
            2 => 
            array (
                'ar_title' => 'الشروط والاحكام',
                'ar_value' => 'image',
                'created_at' => '2021-07-01 16:06:18',
                'en_title' => 'splash image',
                'en_value' => 'image',
                'id' => 6,
                'name' => 'terms',
                'page' => 'النصوص',
                'slug' => 'text',
                'type' => 'long_text',
                'updated_at' => '2021-07-01 16:06:18',
            ),
            3 => 
            array (
                'ar_title' => 'الخصوصية',
                'ar_value' => 'image',
                'created_at' => '2021-07-01 16:06:18',
                'en_title' => 'splash image',
                'en_value' => 'image',
                'id' => 7,
                'name' => 'privacy',
                'page' => 'النصوص',
                'slug' => 'text',
                'type' => 'long_text',
                'updated_at' => '2021-07-01 16:06:18',
            ),
        ));
        
        
    }
}