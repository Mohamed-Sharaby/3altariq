<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;


abstract class Auth extends Controller implements iAuth
{
    public function __construct()
    {

        auth()->shouldUse($this->guard());
    }

    public function loginCredentials()
    {
        return [
            'phone', 'password'
        ];
    }

    public function afterRegister(Request $request,$user)
    {
        //
    }
    public function register(Request $request)
    {
        $validated = $request->validate($this->registrationRules());
        $validated['is_active'] = 1;
        $validated['is_confirmed'] = 0;
//        $validated['confirmation_code']=rand(100000,99999);
        $validated['confirmation_code']=rand(100000,999999);
        if ($request->has('location')){
            if ($request->location=='ثابت')$validated['location']='fixed';
            if ($request->location=='متحرك')$validated['location']='moving';
        }
        \DB::beginTransaction();
        $user = $this->Model()::create($validated);
        sendSms($request->phone,'code : '.$validated['confirmation_code']);
        $this->afterRegister($request,$user);
        $user->token = \JWTAuth::fromUser($user);
        \DB::commit();
        $resource = $this->resource();
        return \responder::success(new $resource($user));
    }


    public function login(Request $request)
    {
        $validated = $request->validate($this->loginRules());
        $attemp = auth()->attempt($request->only($this->loginCredentials()));
        if (!$attemp) {
            return \responder::error("wrong credentials");
        }
        $user = auth()->user();
        $user->update($request->only('fcm_token_android','fcm_token_ios'));
        $user->token = \JWTAuth::fromUser($user);
        $resource = $this->resource();
        return \responder::success(new $resource($user));
    }


    public function profile()
    {
        $user = auth($this->guard())->user();
        $user->token = \JWTAuth::fromUser($user);
        $resource = $this->resource();
        return \responder::success(new $resource($user));
    }

    protected function afterUpdate(Request $request ,$user)
    {

    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate($this->updateProfileRules($user));
        $user->update($validated);
        $user->token = \JWTAuth::fromUser($user);
        $this->afterUpdate($request,$user);
        $resource = $this->resource();
        return \responder::success(new $resource($user));
    }


//    public function updateProfileRules($user)
//    {
//        return [
//            'name' => 'sometimes',
//            'email' => 'sometimes|email|unique:users,' . $user->id,
//            'phone' => 'sometimes|numeric|unique:users,phone,' . $user->id,
//            'password' => 'sometimes|confirmed',
//        ];
//    }

    public function logout(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required',
        ]);
        auth()->user()->devices()->where('devices.id', $request['token'])->delete();
        auth()->logout();
        return \responder::success(__('logged out successfully !'));
    }


}
