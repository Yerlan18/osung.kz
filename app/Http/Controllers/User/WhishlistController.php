<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;

class WhishlistController extends Controller
{
    public function AddToWishList(Request $request, $data)
    {
        if (Auth::check()) {

            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $data)->first();
            if (!$exists) {
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $data,
                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist']);
            } else {
                return response()->json(['error' => 'This product already in your Wishlist']);
            }
        } else {

            return response()->json(['error' => 'At First Login Your Account']);
        }
    }

    public function ViewWishlist()
    {
        if (Auth::check()) {
            $products = Wishlist::with('product')->where('user_id', Auth::id())->get();
            return view('frontend.wishlist.view', compact('products'));
        } else {
            return response()->json(['error' => 'At First Login Your Account']);
        }
    }

    public function GetWishlistProduct()
    {

        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        return response()->json($wishlist);
    } // end mehtod 

    public function RemoveItemWishlist($data)
    {
        Wishlist::find($data)->delete();
        return response()->json(['success' => 'Your item has been deleted']);
    }
}
