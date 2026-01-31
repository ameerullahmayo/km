<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductOrder;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // Generate Unique Order Number (e.g., 001, 002, 003)
        $orderNumber = str_pad(Order::count() + 1, 3, '0', STR_PAD_LEFT);

        // Validate Product Data Before Processing
        if (!isset($request->products) || !is_array($request->products)) {
            return response()->json([
                'message' => 'Invalid products data format',
            ], 400);
        }

        // Create Order with all fields (if provided)
        $order = Order::create([
            'user_id'             => $request->user_id,
            'order_number'        => $orderNumber,
            'total_price'         => 0, // Will be updated after product addition
            'discount'            => $request->discount ?? 0,
            'tax'                 => $request->tax ?? 0,
            'shipping_status'     => $request->shipping_status ?? 'pending',
            'order_status'        => $request->order_status ?? 'pending',
            'payment_status'      => $request->payment_status ?? 'pending',
            'shipping_cost'       => $request->shipping_cost ?? 0,
            'payment_method'      => $request->payment_method ?? null,
            'transaction_id'      => $request->transaction_id ?? null,
            'card_type'           => $request->card_type ?? null,
            'card_last_four'      => $request->card_last_four ?? null,
            'card_expiry'         => $request->card_expiry ?? null,
            'billing_address'     => $request->billing_address ?? null,
            'billing_city'        => $request->billing_city ?? null,
            'billing_country'     => $request->billing_country ?? null,
            'billing_postal_code' => $request->billing_postal_code ?? null,
            'shipping_address'    => $request->shipping_address ?? null,
            'shipping_city'       => $request->shipping_city ?? null,
            'shipping_state'      => $request->shipping_state ?? null,
            'shipping_country'    => $request->shipping_country ?? null,
            'shipping_postal_code'=> $request->shipping_postal_code ?? null,
        ]);

        $totalPrice = 0;

        // Add Products to Order
        foreach ($request->products as $product) {
            if (!isset($product['product_id'], $product['quantity'], $product['price'])) {
                return response()->json([
                    'message' => 'Invalid product details',
                ], 400);
            }

            $orderProduct = ProductOrder::create([
                'order_id'   => $order->id,
                'product_id' => $product['product_id'],
                'quantity'   => $product['quantity'],
                'price'      => $product['price'],
            ]);

            $totalPrice += $orderProduct->quantity * $orderProduct->price;
        }

        // Update Total Price in Order
        $order->update(['total_price' => $totalPrice]);

        return response()->json([
            'message' => 'Order placed successfully!',
            'order'   => $order->load('orderProducts'),
        ], 201);
    }

    public function myOrders()
    {
        $orders = Order::userOrders();

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }
