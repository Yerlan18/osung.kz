<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function Viewbrand()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }


    public function BrandStore(Request $request)
    {

        $not = [
            'message' => 'Brand has been added',
            'alert-type' => 'success'
        ];


        if ($request->file('brand_image')) {
            $hid = hexdec(uniqid());
            $file = $request->file('brand_image');
            $ext = $file->getClientOriginalExtension();
            $fName = $hid . '.' . $ext;
            $path = 'upload/brand_images/';
            $db = $path . $fName;
            $file->move(public_path($path), $fName);
            Brand::create([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ru' => $request->brand_name_ru,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_ru' => strtolower(str_replace(' ', '-', $request->brand_name_ru)),
                'brand_image' => $db,
            ]);

            return redirect()->back()->with($not);
        }
    }

    public function ViewUpdate($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }
    public function BrandUpdate(Request $request)
    {
        $not = [
            'message' => 'Brand has been added',
            'alert-type' => 'success'
        ];

        $brand_id = $request->id;
        $oldimg = $request->oldimg;

        if ($request->file('brand_image')) {
            unlink($oldimg);
            $hid = hexdec(uniqid());
            $file = $request->file('brand_image');
            $ext = $file->getClientOriginalExtension();
            $fName = $hid . '.' . $ext;
            $path = 'upload/brand_images/';
            $db = $path . $fName;
            $file->move(public_path($path), $fName);
            Brand::FindOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ru' => $request->brand_name_ru,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_ru' => strtolower(str_replace(' ', '-', $request->brand_name_ru)),
                'brand_image' => $db,
            ]);

            return redirect()->back()->with($not);
        } else {
            Brand::FindOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_ru' => $request->brand_name_ru,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_ru' => strtolower(str_replace(' ', '-', $request->brand_name_ru)),
            ]);
            return redirect()->back()->with($not);
        }
    }


    public function DeleteItem($id)
    {
        $not = [
            'message' => 'Brand has been deleted',
            'alert-type' => 'error'
        ];
        $old = Brand::find($id)->brand_image;
        unlink($old);

        Brand::FindOrFail($id)->delete();

        return redirect()->back()->with($not);
    }
}
