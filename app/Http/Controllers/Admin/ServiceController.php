<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Services');
    }


    public function index(Request $request)
    {
        $category = Category::findOrFail($request->category);
        $services = Service::whereCategoryId($category->id)->get();
        return view('dashboard.services.index', compact('services', 'category'));
    }


    public function create(Request $request)
    {
        $category = Category::findOrFail($request->category);
        return view('dashboard.services.create', compact('category'));
    }

    public function show(Service $service)
    {
        $service_cities = $service->provider()->join('countries', 'countries.id', '=', 'providers.country_id')->selectRaw('countries.ar_name as country_name, count(providers.id) as providers_count')->groupBy('countries.id')->get()->map(function ($q){
            return ['label'=>$q->country_name,'value'=>$q->providers_count];
        })->toArray();
        return view('dashboard.services.show')->with('service', $service)->with('service_cities', $service_cities)->with('category', $service->category);
    }

    public function store(ServiceRequest $request)
    {
        $category = Category::findOrFail($request->category_id);
        $validator = $request->validated();
        $validator['category_id'] = $category->id;
        Service::create($validator);
        return redirect(route('admin.services.index', ['category' => $category]))->with('success', 'تم الاضافة بنجاح');
    }


    public function edit($service_id)
    {
        //  $category = Category::findOrFail($request->category_id);
        $service = Service::findOrFail($service_id);
        return view('dashboard.services.edit', compact('service'));
    }


    public function update(ServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $validator = $request->validated();
        if ($request->image) {
            if ($service->image) {
                deleteImage('uploads', $service->image);
            }
        }

        $service->update($validator);
        return redirect(route('admin.services.index', ['category' => $service->category_id]))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return 'Done';
    }
}
