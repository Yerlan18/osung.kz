<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\State;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function ProductStoreAjax(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        if (Session::has('coupon')) {
            session()->forget('coupon');
        };

        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);
        } else {

            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }
    }


    public function ProductMinicartInfo()
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

    public function RemoveCartProduct($rowId)
    {
        Cart::remove($rowId);
        if (Session::has('coupon')) {
            session()->forget('coupon');
        };
        return response()->json(['success' => 'Successfully Remove From Cart']);
    }


    public function CouponApply(Request $request)
    {


        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => (Cart::total() * $coupon->coupon_discount) / 100,
                'total_amount' => Cart::total() - ((Cart::total() * $coupon->coupon_discount) / 100),
            ]);

            return response()->json([
                'success' => 'Coupon applied successfully'
            ]);
        } else {
            return response()->json([
                'error' => 'Coupon is invalid'
            ]);
        }
        return response()->json($coupon);
    }


    public function CouponCalculation()
    {
        if (Session::has('coupon')) {
            return response()->json([
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ]);
        } else {
            return response()->json(['total' => Cart::total()]);
        };
    }



    public function CouponRemove()
    {
        Session::forget('coupon');

        return response()->json(array('success' => 'Your coupon has been deleted'));
    }


    public function CheckoutView()
    {
        $divisions = Shipping::orderBy('division_area', 'ASC')->get();
        $not = [
            'message' => 'Please add to your cart at least 1 product',
            'alert-type' => 'error'
        ];
        if (Auth::check()) {

            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                return view('frontend.checkout.view', compact('carts', 'cartQty', 'cartTotal', 'divisions'));
            } else {
                return redirect()->to('/')->with($not);
            }
        } else {
            return redirect()->route('login')->with($not);
        }
    }


    public function GetStateForCh($id)
    {
        $states = State::where('district_id', $id)->orderBy('state_name', 'ASC')->get();
        return response()->json($states);
    }
}
