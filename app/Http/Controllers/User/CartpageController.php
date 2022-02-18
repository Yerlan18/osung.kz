<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;

class CartpageController extends Controller
{
    public function MyCartItemsFrom()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();


        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,

        ));
    }


    public function AllCartItems()
    {
        return view('frontend.cart.view');
    }

    public function IncrementCartitem($data)
    {
        $row = Cart::get($data);

        Cart::update($data, $row->qty + 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => (Cart::total() * $coupon->coupon_discount) / 100,
                'total_amount' => Cart::total() - ((Cart::total() * $coupon->coupon_discount) / 100),
            ]);
        };

        return response()->json(['success' => 'Increased']);
    }
    public function DecrementCartitem($data)
    {
        $row = Cart::get($data);

        Cart::update($data, $row->qty - 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => (Cart::total() * $coupon->coupon_discount) / 100,
                'total_amount' => Cart::total() - ((Cart::total() * $coupon->coupon_discount) / 100),
            ]);
        };

        return response()->json(['success' => 'Decreased']);
    }
}
