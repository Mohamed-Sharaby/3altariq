<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function store(Request $request)
    {
       $inputs= $request->validate([
            'email' => 'required|email',
            'image' => 'required|image',
            'ssn' => 'required',
            'ssn_image' => 'required|image',
            'license_image' => 'required|image',
            'car_image' => 'required|image',
        ]);
       $user=auth()->user();

        if ($user->is_verified){
           return  \responder::error(__('already verified !'));
       }elseif($user->verifications()->where('status','pending')->exists()){
            return \responder::error(__('you have already verification request' ));
        }

        auth()->user()->verifications()->create($inputs);

        return \responder::success(__('verification request has been sent to admin'));
    }
}
