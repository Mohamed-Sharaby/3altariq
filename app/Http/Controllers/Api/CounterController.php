<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Provider $provider)
    {

        $request->validate(['type' => 'required|in:whatsapp,phone,profile']);
        $provider->increment("{$request['type']}_counter");

        return \responder::success(true);
    }
}
