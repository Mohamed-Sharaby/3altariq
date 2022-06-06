<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Provider;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Providers');
    }

    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        $verifications = Verification::all();
        return view('dashboard.verifications.index', compact('verifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return
     */
    public function update(Request $request, $id)
    {
        $request->validate(['status'=>'required|in:approved,rejected']);
        $verification = Verification::findOrFail($request->verify_id);
        $provider = Provider::findOrFail($request->provider_id);
        $verification->update(['status' => $request->status]);
        if ($request->status == 'approved') {
            $provider->update(['is_verified' => 1]);
        }
        return redirect(route('admin.verifications.index'))->with('success', 'تم الحفظ بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return
     */
    public function destroy($id)
    {
      //
    }
}
