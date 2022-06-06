<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Provider;
use App\Models\Service;
use App\Models\Setting;
use App\Notifications\GeneralNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ProviderNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Notifications');
    }


    public function index()
    {

        $providers = Provider::active()->get()->pluck('name', 'id');
        $countries = Country::get()->pluck('ar_name', 'id');
        $categories = Category::active()->get()->pluck('ar_name', 'id');
        $services = Service::active()->get()->pluck('ar_name', 'id');
        $balance = SMSBalance();
        $counter = getsetting('provider_counter');
        return view('dashboard.providers.notifications.create', compact('counter','balance', 'providers', 'countries', 'categories', 'services'));
    }


    public function store(Request $request)
    {
        //  dd($request->category);
        $request->validate([
            'country' => 'nullable|exists:countries,id',
            'service' => 'nullable|exists:services,id',
            'category' => 'nullable|exists:categories,id',
            'providers' => 'nullable|array',
            'title' => 'required',
            'body' => 'required',
        ]);
        $data = $request->except('_token');

        $providers = Provider::query();
        $providers->when($request->providers, function ($q) {
            $q->whereIn('id', \request('providers'));
        });

        $providers->when($request->country, function ($q) {
            $q->whereHas('country', function ($query) {
                $query->where('country_id', \request('country'));
            });
        });
        $providers->when($request->service, function ($q) {
            $q->whereHas('service', function ($query) {
                $query->where('service_id', \request('service'));
            });
        });
        $providers->when($request->category, function ($q) {
            $q->whereHas('category', function ($query) {
                $query->where('category_id', \request('category'));
            });
        });


        $providers = $providers->get();

        Notification::send($providers, new GeneralNotification([
            'title' => $data['title'],
            'body' => $data['body'],
        ]));


        if ($request->sms == 1) {
            sendSms($providers->pluck('phone')->implode(','), $data['body']);
            Setting::where('name', 'provider_counter')->increment('ar_value', $providers->count());
        }

        return redirect()->back()->with('success', 'تم ارسال الاشعار بنجاح');
    }

}
