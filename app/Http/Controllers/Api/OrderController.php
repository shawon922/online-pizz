<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\PlaceOrderRequest;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userIp = $request->ip();

        $response = Order::where([
                        ['user_ip', $userIp], 
                    ])->get();
        
        return response()->success($response, trans('messages.success_message'), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PlaceOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceOrderRequest $request)
    {
        $data = $request->all();
        $userIp = $request->ip();
        $cart = Cart::where([
                                ['user_ip', $userIp], 
                            ])->get();

        if ($cart->isEmpty()) {
            throw new HttpResponseException(response()->error(trans('messages.cart_is_empty'), Response::HTTP_NOT_FOUND));
        }

        DB::beginTransaction();

        try {
            $order = Order::create($data);
            $subtotal = $total = 0;

            foreach ($cart as $item) { 
                $unitPrice = $item->product->unit_price;

                $order->products()->attach($item->product_id, [
                    'quantity' => $item->quantity,
                    'unit_price' => $unitPrice,
                ]);

                $subtotal += ($item->quantity * $unitPrice);
            }

            $vat = ($subtotal * 15) / 100;
            $shippingCost = 100;

            $order->user_ip = $userIp;
            $order->subtotal = $subtotal;
            $order->vat = $vat;
            $order->shipping_cost = $shippingCost;
            $order->total = $subtotal + $vat + $shippingCost;
            
            $order->save();

            Cart::where([
                            ['user_ip', $userIp], 
                        ])->forceDelete();

        } catch (\Exception $e) {
            DB::rollBack();

            throw new HttpResponseException(response()->error($e->getMessage(), Response::HTTP_BAD_REQUEST));
        }
        
        DB::commit();

        
        return response()->success(false, trans('messages.success_message'), Response::HTTP_OK);
    }
}
