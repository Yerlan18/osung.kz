<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function MainPage()
    {

        $skip3_cat = Category::skip(3)->first();
        $skip3_product = Product::where('status', 1)->where('category_id', $skip3_cat->id)->orderBy('id', 'DESC')->get();
        $products = Product::where('status', 1)->orderBy('product_name_en', 'DESC')->get();
        $sliders = Slider::where('status', 1)->get();
        $featured = Product::where('featured', 1)->orderBy('ID', 'DESC')->get();
        $hots = Product::where('hot_deals', 1)->orderBy('ID', 'DESC')->get();
        $specials = Product::where('special_offer', 1)->orderBy('ID', 'DESC')->limit(3)->get();
        $deals = Product::where('special_deals', 1)->orderBy('ID', 'DESC')->limit(3)->get();
        return view('frontend.index', compact('sliders', 'products', 'featured', 'hots', 'specials', 'deals', 'skip3_product', 'skip3_cat'));
    }

    public function ULogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile()
    {
        $user = Auth::user();

        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserProfileStore(Request $request)
    {

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $name = hexdec(uniqid());
            $ext = strtolower($file->getClientOriginalExtension());
            $fname = $name . '.' . $ext;
            $path = 'upload/user_images/';
            $file->move(public_path($path), $fname);
            $data['profile_photo_path'] = $fname;
            $data->save();
        }

        $notification = [
            'message' => 'Your profile has been updated',
            'alert-type' => 'success',
        ];





        return redirect()->route('dashboard')->with($notification);
    }

    public function PasswordUpdate()
    {
        return view('frontend.profile.change_password');
    }

    public function PChange(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $not = [
            'message' => 'Your password has been updated',
            'alert-type' => 'success',
        ];
        $note = [
            'message' => 'Please input correct data!',
            'alert-type' => 'error',
        ];


        $hPass = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hPass)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->back()->with($not);
        } else {
            return redirect()->back()->with($note);
        }
    }


    public function ProductDetails($id, $slug)
    {
        $product = Product::findOrFail($id);
        $multiImag = MultiImg::where('product_id', $id)->get();

        return view('frontend.product.product_details', compact('product', 'multiImag'));
    }



    public function ProductTags($tag)
    {
        $products = Product::where('status', 1)->where('product_tags_en', $tag)->where('product_tags_ru', $tag)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::all();
        $subcategory = SubCategory::all();


        return view('frontend.common.tags_view', compact('products', 'categories', 'subcategory'));
    }



    public function ProductSubWise($id, $slug)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::all();
        return view('frontend.product.product_sub', compact('products', 'categories'));
    }

    public function ProductSubSubWise($id, $slug)
    {
        $products = Product::where('status', 1)->where('subsubcategory_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::all();
        return view('frontend.product.product_subsub', compact('products', 'categories'));
    }



    public function ProductViewAjax($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);

        $color = $product->product_color_en;
        $product_color = explode(',', $color);

        $size = $product->product_size_en;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,

        ));
    }
}
