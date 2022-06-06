<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Auth;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Auth
{
    public function guard()
    {
        return 'provider';
    }

    public function Model()
    {
        return Provider::class;
    }

    public function registrationRules(): array
    {

        return [
            'name' => 'required|string|max:191',
            'country_code' => 'required|in:962,965,02',
            'country_id' => 'required|exists:countries,id',
            'service_id' => 'required|exists:services,id',
            'phone' => 'required|phone:eg,jo,kw|unique:providers,phone',
            'password' => 'required|confirmed|min:6|string',
            'location' => 'required|in:fixed,moving,ثابت,متحرك',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,bmp,svg,gif|max:2048',
            'images' => 'sometimes|array',
            'images.*' => 'image',
            'fcm_token_android' => 'required_without:fcm_token_ios',
            'fcm_token_ios' => 'required_without:fcm_token_android',
            'locale'=>'sometimes|in:ar,en'
        ];
    }

    public function afterRegister(Request $request, $user)
    {
        if ($request->has('images')) {
            $user->addMultipleMediaFromRequest(['images'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('images');
            });
        }
        $user->update(['expire_at'=>now()->addMonth()]);

    }

    public function loginRules(): array
    {
        return [
            'phone' => 'required|phone:eg,jo,kw|exists:providers,phone',
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
            'images'=>'sometimes|array',
            'images.*'=>'image',
            'deleted_images'=>'sometimes|array',
            'deleted_images.*'=>'exists:media,id',
            'bio'=>'sometimes|string',
            'locale'=>'sometimes|in:ar,en'

        ];
    }

    public function  afterUpdate(Request $request,$user)
    {

        if ($request->has('images')) {
            $user->addMultipleMediaFromRequest(['images'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('photos');
            });
        }
        if ($request->has('deleted_images')){
            $user->media()->whereIn('id',$request['deleted_images'])->delete();
        }
    }
    public function ConfirmUser(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'phone' => 'required|phone:eg,jo,kw',
            'code' => 'required'
        ]);
        $user = Provider::where('phone', $request['phone'])->where('is_confirmed', 0)->where('confirmation_code', $request['code'])->first();
        if ($user) {
            $user->update(['is_confirmed' => 1, 'confirmation_code' => Str::random(10)]);
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
        $user = Provider::where('phone', $request['phone'])->where('is_confirmed', 0)->first();
        if ($user) {
            $user->update(['confirmation_code' => 123456]);
            return \responder::success(true);
        } else {
            return \responder::error(__('something went wrong'));
        }
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:providers,phone',
        ]);
        $user = Provider::where('phone', $request->phone)->first();
        $code=rand(100000,999999);
        $user->update([
            'reset_code' => $code,
            'reset_at' => now()->toDateTimeString()
        ]);
        sendSms($user->phone,"كود استعادة كلمة المرور هو : ".$code);

        return \responder::success(__('reset code sent successfully !'));
    }

    public function checkCode(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:providers,phone',
            'reset_code' => 'required'
        ]);
        $user = Provider::where('phone', $request->phone)->where('reset_code', $request->reset_code)->exists();
        if ($user) {
            return \responder::success($user);
        } else {
            return \responder::error(__('something went wrong'));
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:providers,phone',
            'reset_code' => 'required',
            'password' => 'required'
        ]);
        $user = Provider::where('phone', $request->phone)->where('reset_code', $request->reset_code)->first();
        if (!$user) return \responder::error(__('wrong reset code '));

        $user->update([
            'password' => $request->password,
            'reset_code' => Str::random(15)
        ]);
        $user->token = \JWTAuth::fromUser($user);
        $resource = $this->resource();
        return \responder::success(new $resource($user));
    }

    public function resource()
    {
        return ProviderResource::class;
    }


    public function profile()
    {
        $user = auth($this->guard())->user();
//        $providers->withCount(['PendingOrders','CanceledOrders','FinishedOrders','OnTheWayOrders','orders']);
        $user->on_the_way_orders_count=$user->OnTheWayOrders()->count();
        $user->canceled_orders_count=$user->CanceledOrders()->count();
        $user->finished_orders_count=$user->FinishedOrders()->count();
        $user->pending_orders_count=$user->PendingOrders()->count();
        $user->orders_count=$user->Orders()->count();
        $user->orders_avg_rate=$user->orders()->avg('rate');
        $user->has_accepted_order=$user->orders()->where('status','accepted')->exists();

        $user->token = \JWTAuth::fromUser($user);
        $resource = $this->resource();
        return \responder::success(new $resource($user));
    }

}
