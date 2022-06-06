<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Provider;
use App\Models\Service;
use App\Services\FirestoreProviders;
use Google\Cloud\Core\GeoPoint;
use Illuminate\Database\Seeder;

class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->has(Service::factory()->has(Provider::factory()->count(1)->afterCreating(function ($model){
            (new FirestoreProviders())->push('test',$model->id,[
                'id'=>$model->id,
                'location'=>new GeoPoint(mt_rand(31.0110462*10000000,31.371156*10000000)/10000000,mt_rand(31.347597*10000000,31.4400129*10000000)/10000000),
                'is_online'=>true,
                'service_id'=>$model->service_id
            ]);
        }))->count(1))->count(1)->create();
    }
}
