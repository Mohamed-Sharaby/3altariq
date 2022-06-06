<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProviderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderRequest;
use App\Models\Provider;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Providers');
    }


    public function index(ProviderDataTable $dataTable)
    {
        return $dataTable->render('dashboard.providers.index');
    }


    public function create()
    {
        $services = \App\Models\Service::active()->get()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
        $countries = \App\Models\Country::get()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
        return view('dashboard.providers.create', compact('services', 'countries'));
    }


    public function store(ProviderRequest $request)
    {
        $validator = $request->validated();

        DB::beginTransaction();
        $service = Service::findOrFail($validator['service_id']);
        $validator['category_id'] = $service->category_id;
        $provider = Provider::create($validator);

        if ($request->has('photos')) {
            $provider->addMultipleMediaFromRequest(['photos'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('photos');
            });
        }
        DB::commit();
        return redirect(route('admin.providers.index'))->with('success', 'تم الاضافة بنجاح');
    }

    public function show(Provider $provider)
    {
        $statistics=[
            ['label'=>'في الطريق','value'=>$provider->OnTheWayOrders()->FilterDate(\request('from'),\request('to'))->count()],
            ['label'=>'الملغية','value'=>$provider->CanceledOrders()->FilterDate(\request('from'),\request('to'))->count()],
            ['label'=>'المنتهية','value'=>$provider->FinishedOrders()->FilterDate(\request('from'),\request('to'))->count()],
            ['label'=>'المعلقة','value'=>$provider->PendingOrders()->FilterDate(\request('from'),\request('to'))->count()],
        ];
        return view('dashboard.providers.show', compact('provider'))->with('statistics',$statistics);
    }


    public function edit(Provider $provider)
    {
        $services = \App\Models\Service::active()->get()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
        $countries = \App\Models\Country::get()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
        return view('dashboard.providers.edit', compact('provider', 'services', 'countries'));
    }


    public function update(ProviderRequest $request, Provider $provider)
    {
        $validator = $request->validated();
        $validator['category_id'] = $provider->service->category_id;
        DB::beginTransaction();
        if ($request->image) {
            if ($provider->image) {
                $image = str_replace(url('/') . '/storage/', '', $provider->image);
                deleteImage('uploads', $image);
            }
        }
        if ($request->has('photos')) {
            $provider->addMultipleMediaFromRequest(['photos'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('photos');
            });
        }

        $provider->update($validator);
        DB::commit();
        return redirect(route('admin.providers.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Provider $provider)
    {
        $provider->delete();
        return 'Done';
    }

}
