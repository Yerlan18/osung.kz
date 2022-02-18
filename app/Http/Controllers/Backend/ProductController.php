<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\MultiImg;
use Image;

class ProductController extends Controller
{


    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.add_product', compact('categories', 'brands'));
    }


    public function StoreProduct(Request $request)
    {




        $file = $request->file('product_thumbnail');
        $ext = $file->getClientOriginalExtension();
        $uniqid = hexdec(uniqId());
        $name = $uniqid . '.' . $ext;
        $path = 'upload/product_thumbnail/';
        Image::make($file)->resize(900, 800)->save($path . $name);
        $location = $path . $name;



        $not = array(
            'message' => 'Product has been added',
            'alert-type' => 'success'
        );



        $idOfProduct = Product::create([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ru' => $request->product_name_ru,
            'product_slug_en' => strtolower(str_replace(' ', '_', $request->product_name_en)),
            'product_slug_ru' => strtolower(str_replace(' ', '_', $request->product_name_ru)),
            'product_qty' => $request->product_qty,
            'product_code' => $request->product_code,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ru' => $request->product_tags_ru,
            'product_size_en' => $request->product_size_en,
            'product_size_ru' => $request->product_size_ru,
            'product_color_en' => $request->product_color_en,
            'product_color_ru' => $request->product_color_ru,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc_en' => $request->short_desc_en,
            'short_desc_ru' => $request->short_desc_ru,
            'long_desc_en' => $request->long_desc_en,
            'long_desc_ru' => $request->long_desc_ru,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'product_thumbnail' => $location,
        ])->id;





        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $extii = $img->getClientOriginalExtension();
            $uniqidd = hexdec(uniqId());
            $fname = $uniqidd . '.' . $extii;
            $pathh = 'upload/product_images/';
            Image::make($img)->resize(900, 800)->save($pathh . $fname);
            $location = $pathh . $fname;


            MultiImg::create([
                'product_id' => $idOfProduct,
                'photo_name' => $location,
            ]);
        }

        return redirect()->route('manage-product')->with($not);
    }


    public function ManageProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.manage_product', compact('products'));
    }


    public function EditProduct($id)
    {

        $product = Product::FindOrFail($id);
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();
        $multiImg = MultiImg::where('product_id', $id)->get();


        return view('backend.product.edit_product', compact('product', 'categories', 'brands', 'subcategory', 'subsubcategory', 'multiImg'));
    }


    public function UpdateProduct(Request $request)
    {
        $id = $request->id;
        Product::FindOrFail($id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ru' => $request->product_name_ru,
            'product_slug_en' => strtolower(str_replace(' ', '_', $request->product_name_en)),
            'product_slug_ru' => strtolower(str_replace(' ', '_', $request->product_name_ru)),
            'product_qty' => $request->product_qty,
            'product_code' => $request->product_code,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ru' => $request->product_tags_ru,
            'product_size_en' => $request->product_size_en,
            'product_size_ru' => $request->product_size_ru,
            'product_color_en' => $request->product_color_en,
            'product_color_ru' => $request->product_color_ru,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc_en' => $request->short_desc_en,
            'short_desc_ru' => $request->short_desc_ru,
            'long_desc_en' => $request->long_desc_en,
            'long_desc_ru' => $request->long_desc_ru,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
        ]);

        $not = array(
            'message' => 'Your product has been updated',
            'alert-type' => 'info',
        );


        return redirect()->route('manage-product')->with($not);
    }




    public function UpdateImgProduct(Request $request)
    {

        $not = array(
            'message' => 'Your product has been updated',
            'alert-type' => 'info',
        );


        $id = $request->multi_img;



        foreach ($id as $k => $img) {
            $imgId = MultiImg::find($k);
            unlink($imgId->photo_name);
            $ext = $img->getClientOriginalExtension();
            $uniqid = hexdec(uniqId());
            $name = $uniqid . '.' . $ext;
            $path = 'upload/product_images/';
            Image::make($img)->resize(900, 800)->save($path . $name);
            $location = $path . $name;

            MultiImg::where('id', $k)->update([

                'photo_name' => $location,
            ]);
        }

        return redirect()->back()->with($not);
    }

    function UpdateThumbnail(Request $request)
    {
        $id = $request->id;
        $old = $request->old_img;
        unlink($old);


        $file = $request->file('product_thumbnail');
        $ext = $file->getClientOriginalExtension();
        $uniqid = hexdec(uniqId());
        $name = $uniqid . '.' . $ext;
        $path = 'upload/product_thumbnail/';
        Image::make($file)->resize(900, 800)->save($path . $name);
        $location = $path . $name;
        Product::find($id)->update([

            'product_thumbnail' => $location,
        ]);


        $not = array(
            'message' => 'Your product has been updated',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($not);
    }

    public function DeleteMultiImg($id)
    {
        $id = MultiImg::find($id);
        unlink($id->photo_name);
        $id->delete();

        $not = array(
            'message' => 'Your product has been updated',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($not);
    }


    public function ProductInactive($id)
    {
        Product::find($id)->update(['status' => 0]);
        $not = array(
            'message' => 'Your product Inactive',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($not);
    }

    public function ProductActive($id)
    {
        Product::find($id)->update(['status' => 1]);
        $not = array(
            'message' => 'Your product Active',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($not);
    }

    public function ProductDeleting($id)
    {
        $pro = Product::FindOrFail($id);
        unlink($pro->product_thumbnail);

        $mul = MultiImg::where('product_id', $id)->get();
        foreach ($mul as $img) {
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }
        $pro->delete();
        $not = array(
            'message' => 'Your producd has been deleted',
            'alert-type' => 'danger',
        );

        return redirect()->back()->with($not);
    }
}
