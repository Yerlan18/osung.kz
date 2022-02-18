<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function ManageCoupon()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.view', compact('coupons'));
    }


    public function StoreCoupon(Request $request)
    {
        Coupon::create([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
        ]);

        return redirect()->back()->with('success');
    }


    public function CouponInactive($id)
    {
        Coupon::find($id)->update(['status' => 0]);
        $not = array(
            'message' => 'Your product is inactive',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($not);
    }

    public function CouponActive($id)
    {
        Coupon::find($id)->update(['status' => 1]);
        $not = array(
            'message' => 'Your product is active',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($not);
    }

    public function CouponEdit($id)
    {
        $coup = Coupon::FindOrFail($id);

        return view('backend.coupon.edit', compact('coup'));
    }


    public function UpdateCoupon(Request $request, $id)
    {
        Coupon::find($id)->update([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
        ]);

        return redirect()->route('manage-coupon');
    }

    public function CouponDelete($id)
    {
        Coupon::find($id)->delete();
        return redirect()->route('manage-coupon');
    }
}
