<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Auth;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Auth
{
    public function guard()
    {
        return 'api';
    }

    public function Model()
    {
        return User::class;
    }

    public function registrationRules(): array
    {

        return [
            'name' => 'required|string|max:191',
            'country_code' => 'required|in:962,965,02',
            'phone' => 'required|phone:eg,jo,kw|unique:users,phone',
            'password' => 'required|confirmed|min:6|string',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,bmp,svg,gif|max:2048',
            'fcm_token_android' => 'required_without:fcm_token_ios',
            'fcm_token_ios' => 'required_without:fcm_token_android',
            'locale'=>'sometimes|in:ar,en'
        ];
    }


    public function loginRules(): array
    {
        return [
            'phone' => 'required|phone:eg,jo,kw|exists:users,phone',
            'password' => 'required|min:6|string',
            'fcm_token_android' => 'required_without:fcm_token_ios',
            'fcm_token_ios' => 'required_without:fcm_token_android',
        ];
    }


    public function updateProfileRules($user)
    {
        return [
            'name' => 'sometimes|string|max:191',
            'password' => 'sometimes|confirmed|min:6|string',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,bmp,svg,gif|max:2048',
            'locale'=>'sometimes|in:ar,en'
        ];
    }


    public function resource()
    {
        return UserResource::class;
    }

    public function ConfirmUser(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'phone' => 'required|phone:eg,jo,kw',
            'code' => 'required'
        ]);
        $user = User::where('phone', $request['phone'])->where('is_confirmed',0)->where('confirmation_code', $request['code'])->first();
        if ($user) {
            $user->update(['is_confirmed' => 1,'confirmation_code'=>Str::random(10)]);
            return \responder::success(true);
        } else {
            return \responder::error(__('something went wrong'));
        }
    }
    public function resendConfirmation(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'phone' => 'required|phone:eg,jo,kw',
        ]);
        $user = User::where('phone', $request['phone'])->where('is_confirmed',0)->first();
        if ($user) {
            $code=123456;
            $user->update(['confirmation_code'=>$code]);
            sendSms($user->phone,'code : '.$code);

            return \responder::success(true);
        } else {
            return \responder::error(__('something went wrong'));
        }
    }


    public function forgetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone',
        ]);
        $user = User::where('phone', $request->phone)->first();
        $code=rand(1000000,999999);
        $user->update([
            'reset_code' => $code,
            'reset_at' => now()->toDateTimeString()
        ]);

        sendSms($user->phone,'code : '.$code);

        return \responder::success(__('reset code sent successfully !'));
    }

    public function checkCode(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone',
            'reset_code' => 'required'
        ]);
        $user = User::where('phone', $request->phone)->where('reset_code', $request->reset_code)->exists();

        return \responder::success($user);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone',
            'reset_code' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('phone', $request->phone)->where('reset_code', $request->reset_code)->first();
        if (!$user) return \responder::error(__('wrong reset code '));

        $user->update([
            'password' => $request->password,
            'reset_code' => Str::random(15)
        ]);
        $user->token = \JWTAuth::fromUser($user);
        return \responder::success(new UserResource($user));
    }


}
