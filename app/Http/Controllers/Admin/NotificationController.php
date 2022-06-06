<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\GeneralNotification;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Notifications');
    }


    public function index()
    {
        return view('dashboard.users.notifications.index', ['notifications' => DatabaseNotification::where('notifiable_type', 'App\Models\User')->latest()->paginate(12)]);
    }


    public function create()
    {
        $users = User::active()->get();
        $balance = SMSBalance();
        $counter = getsetting('user_counter');

        return view('dashboard.users.notifications.create', compact('counter','balance','users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'users' => 'required|array',
            'title' => 'required',
            'body' => 'required',
        ]);
        $data = $request->except('_token');
        $users = User::whereIn('id', $data['users'])->get();
        Notification::send($users, new GeneralNotification([
            'title' => $data['title'],
            'body' => $data['body'],
        ]));

        if ($request->sms == 1) {
            sendSms($users->pluck('phone')->implode(','), $data['body']);
            Setting::where('name', 'user_counter')->increment('ar_value', $users->count());
        }


        return redirect()->back()->with('success', 'تم ارسال الاشعار بنجاح');
    }


    public function destroy($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        $notification->delete();
        return 'Done';
    }
}
