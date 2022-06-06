<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Settings');
    }
    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        $pages = Setting::where('type','!=','hidden')->pluck('page')->unique();
        return view('dashboard.settings.index', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            if ($key == '_token' || !$value) continue;
            {
                if (is_array($value)) {
                    Setting::where(['name' => $key])->update(['ar_value' => $value[0], 'en_value' => $value[1]]);
                } else {
                    Setting::where(['name' => $key])->update(['ar_value' => $value, 'en_value' => $value]);
                }
            }
        }
        return redirect()->back()->with('success', 'تم التعديل بنجاح');

    }


    public function show($id)
    {
        $settings = Setting::wherePage($id)->get();
        $page = $id;
        return view('dashboard.settings.show', compact('settings', 'page'));
    }


}
