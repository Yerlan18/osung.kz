<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;

class SubCategoryController extends Controller
{
    public function ViewSubcategory()
    {
        $cat = Category::orderBy('category_name_en', 'ASC')->get();
        $subcat = SubCategory::latest()->get();
        return view('backend.category.subcategory_view', compact('subcat', 'cat'));
    }


    public function SubCategoryStore(Request $request)
    {
        $not = [
            'message' => 'SubCategory has been added',
            'alert-type' => 'success'
        ];
        SubCategory::create([
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ru' => $request->subcategory_name_ru,
            'category_id' => $request->category_id,
            'subcategory_slug_en' => strtolower(str_replace(' ', '_', $request->subcategory_name_en)),
            'subcategory_slug_ru' => strtolower(str_replace(' ', '_', $request->subcategory_name_ru)),
        ]);

        return redirect()->back()->with($not);
    }

    public function SubCategoryUpdate($id)
    {
        $cat = Category::orderBy('category_name_en', 'ASC')->get();
        $subcat = SubCategory::FindOrFail($id);
        return view('backend.category.subcategory_edit', compact('subcat', 'cat'));
    }

    public function SubCatUpdate(Request $request, $id)
    {
        $not = array('message' => 'Info has been updated', 'alert-type' => 'success');

        SubCategory::find($id)->update([
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ru' => $request->subcategory_name_ru,
            'category_id' => $request->category_id,
            'subcategory_slug_en' => strtolower(str_replace(' ', '_', $request->subcategory_name_en)),
            'subcategory_slug_ru' => strtolower(str_replace(' ', '_', $request->subcategory_name_ru)),
        ]);
        return redirect()->route('all.subcategories')->with($not);
    }

    public function DeleteSubCategory($id)
    {
        $not = array('message' => 'Info has been deleted', 'alert-type' => 'success');
        SubCategory::find($id)->delete();
        return redirect()->back()->with($not);
    }


    public function ViewSubSubcategory()
    {
        $cat = Category::orderBy('category_name_en', 'ASC')->get();
        $subsubcat = SubSubCategory::latest()->get();
        return view('backend.category.subsubcategory_view', compact('subsubcat', 'cat'));
    }


    public function GetSubCategory($category_id)
    {
        $data = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($data);
    }

    public function SubSubCategoryStore(Request $request)
    {
        $not = [
            'message' => 'SubSubCategory has been added',
            'alert-type' => 'success'
        ];
        SubSubCategory::create([
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_ru' => $request->subsubcategory_name_ru,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '_', $request->subsubcategory_name_en)),
            'subsubcategory_slug_ru' => strtolower(str_replace(' ', '_', $request->subsubcategory_name_ru)),
        ]);

        return redirect()->back()->with($not);
    }

    public function EditSububCategory($id)
    {
        $cat = Category::orderBy('category_name_en', 'ASC')->get();
        $data = SubSubCategory::find($id);
        $sdata = SubCategory::all();
        return view('backend.category.subsubcategory_edit', compact('data', 'cat', 'sdata'));
    }

    public function SubSubCategoryUpdate(Request $request)
    {
        $id = $request->id;
        $not = [
            'message' => 'SubSubCategory has been added',
            'alert-type' => 'success'
        ];
        SubSubCategory::FindOrFail($id)->update([
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_ru' => $request->subsubcategory_name_ru,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '_', $request->subsubcategory_name_en)),
            'subsubcategory_slug_ru' => strtolower(str_replace(' ', '_', $request->subsubcategory_name_ru)),
        ]);

        return redirect()->route('all.subsubcategories')->with($not);
    }


    public function SubSubCategoryDelete($id)
    {
        $not = [
            'message' => 'SubSubCategory has been deleted',
            'alert-type' => 'error'
        ];
        SubSubCategory::find($id)->delete();
        return redirect()->back()->with($not);
    }

    public function GetSubSubCategory($subcategory_id)
    {

        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subsubcat);
    }
}
