<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Provider;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DashboardController extends Controller
{
    public function index()
    {


        $data = ['providers_in_country' => Country::whereHas('providers')->withCount('providers')->get()->map(function ($q){
            return ['label'=>$q->ar_name,'value'=>$q->providers_count];
        })->toArray(),
            'daily_providers'=>Provider::selectRaw('count(id) as providers , DATE(created_at) as date_created_at')->groupBy('date_created_at')->get()->toArray(),
            'daily_users'=>User::selectRaw('count(id) as users , DATE(created_at) as date_created_at')->groupBy('date_created_at')->get()->toArray(),

        ];
        return view('dashboard.layouts.main')->with($data);
    }


    public function active($id, $className)
    {
        $baseClass = 'App\Models\\' . $className;
        $model = $baseClass::findOrFail($id);
        $model->update(['is_active' => !$model->is_active]);

        if ($className == 'Category') {
            $model->services()->update(['is_active' => $model->is_active]);
        }

        return back()->with('success', __('تم التحديث بنجاح'));
    }


    public function deletePhoto($id)
    {
        $photo = Media::findOrFail($id);
        $photo->delete();
        return response()->json([
            'status' => true,
            'id' => $photo->id,
        ]);
    }

    public function reviewed($id)
    {
        $provider = Provider::findOrFail($id);
        $provider->update(['is_reviewed' => !$provider->is_reviewed]);
        return back()->with('success', __('تم التحديث بنجاح'));
    }

}
