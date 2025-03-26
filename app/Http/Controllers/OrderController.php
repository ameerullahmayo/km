<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $orders = Order::all();

        return view('backend.orders.index' , compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

        public function updateStatus(Request $request, $id)
        {
        // Validate the request
            $request->validate([

                'order_status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
            ]);

            try {
                // Find the order and update status
                $order = Order::findOrFail($id);
                $order->order_status = $request->order_status;
                $order->save();

                return redirect()->back()->with('success', 'Order status updated successfully!');
            } catch (\Exception $e) {

                return redirect()->back()->with('error', 'Failed to update order status.');
                }
        }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
