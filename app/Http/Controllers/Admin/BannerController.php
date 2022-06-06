<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Models\Country;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Banners');
    }


    public function index()
    {
        $banners = Banner::latest()->get();
        return view('dashboard.banners.index', compact('banners'));
    }


    public function create()
    {
        $countries = Country::parents()->get()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
        return view('dashboard.banners.create', compact('countries'));
    }


    public function store(BannerRequest $request)
    {
        $validator = $request->validated();
        Banner::create($validator);
        return redirect(route('admin.banners.index'))->with('success', 'تم الاضافة بنجاح');
    }


    public function edit(Banner $banner)
    {
        $countries = Country::parents()->get()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['ar_name']];
        });
        return view('dashboard.banners.edit', compact('banner', 'countries'));
    }


    public function update(BannerRequest $request, Banner $banner)
    {
        $validator = $request->validated();
        if ($request->image) {
            if ($banner->image) {
                $image = str_replace(url('/') . '/storage/', '', $banner->image);
                deleteImage('uploads', $image);
            }
        }

        $banner->update($validator);
        return redirect(route('admin.banners.index'))->with('success', 'تم التعديل بنجاح');
    }


    public function destroy(Banner $banner)
    {
        $banner->delete();
        return 'Done';
    }
}
