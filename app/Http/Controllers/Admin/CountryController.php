<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Countries');
    }


    public function index()
    {
        $countries = Country::all();
        return view('dashboard.countries.index', compact('countries'));
    }


    public function create()
    {
        $parents = Country::get()->pluck('name','id');
        return view('dashboard.countries.create',compact('parents'));
    }


    public function store(CountryRequest $request)
    {
        $validator = $request->validated();
        Country::create($validator);
        return back()->with('success', 'تم الاضافة بنجاح');
    }


    public function edit(Country $country)
    {
        $parents = Country::get()->pluck('name','id');
        return view('dashboard.countries.edit', compact('country','parents'));
    }


    public function update(CountryRequest $request, Country $country)
    {
        $validator = $request->validated();
        $country->update($validator);
        return redirect(route('admin.countries.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Country $country)
    {
        $childCountries = Country::whereParentId($country->id)->exists();
        if ($childCountries){
            return redirect()->back()->with('error','لا يمكن الحذف .. يوجد مدن تنتمى اليها');
        }elseif (count($country->providers) > 0){
           return redirect()->back()->with('error','لا يمكن الحذف .. يوجد مقدمين خدمة تنتمى لهذة المدينة');
        }
        else{
            $country->delete();
            return 'Done';
        }

    }
}
