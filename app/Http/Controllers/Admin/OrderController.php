<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(OrdersDataTable $dataTable)
    {
        // $orders = Order::all();
        // return view('dashboard.orders.index', compact('orders'));
        return $dataTable->render('dashboard.orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show(Order $order)
    {
        return view('dashboard.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
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
    public function update(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,rejected,canceled,wait_for_rate,finished','on_the_way']);

        $order->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'تم تغيير الحالة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return 'Done';
    }
}
