<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Product;
use App\Models\Cart;

use App\Http\Requests\AddToCartRequest;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userIp = $request->ip();

        $response = Cart::where([
                        ['user_ip', $userIp], 
                    ])->get();
        
        return response()->success($response, trans('messages.success_message'), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddToCartRequest $request)
    {
        $data = $request->all();
        $userIp = $request->ip();
        
        $product = Product::find($data['product_id']);
        if (!$product) {
            throw new HttpResponseException(response()->error(trans('messages.product_not_found'), Response::HTTP_NOT_FOUND));
        }

        $cartItem = Cart::where([
                                ['product_id', $product->id], 
                                ['user_ip', $userIp], 
                            ])->first();

        if ($cartItem) {
            $cartItem->quantity = !empty($data['quantity']) ? $data['quantity'] : 1;
        } else {
            $cartItem = Cart::create($data);
        }

        $cartItem->user_ip = $userIp;
        $cartItem->save();

        return response()->success(false, trans('messages.added_to_cart'), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        if (!$cart->forceDelete()) {
            throw new HttpResponseException(response()->error(trans('messages.error_message'), Response::HTTP_BAD_REQUEST));
        }
        
        return response()->success(false, trans('messages.success_message'), Response::HTTP_OK);
    }
}
