<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function Viewcategory()
    {
        $category = Category::latest()->get();
        return view('backend.category.category_view', compact('category'));
    }

    public function CategoryStore(Request $request)
    {
        $not = [
            'message' => 'Category has been added',
            'alert-type' => 'success'
        ];
        Category::create([
            'category_name_en' => $request->category_name_en,
            'category_name_ru' => $request->category_name_ru,
            'category_slug_en' => strtolower(str_replace(' ', '_', $request->category_name_en)),
            'category_slug_ru' => strtolower(str_replace(' ', '_', $request->category_name_ru)),
            'category_icon' => $request->category_icon,
        ]);

        return redirect()->back()->with($not);
    }

    public function CategoryUpdate($id)
    {
        $cat = Category::FindOrFail($id);

        return view('backend.category.category_edit', compact('cat'));
    }

    public function CatUpdate(Request $request, $id)
    {
        $not = array('message' => 'Info has been updated', 'alert-type' => 'success');

        Category::find($id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_ru' => $request->category_name_ru,
            'category_name_icon' => $request->category_icon,
        ]);
        return redirect()->route('all.categories')->with($not);
    }

    public function DeleteCategory($id)
    {
        Category::find($id)->delete();
        $not = array('message' => 'Category has been deleted', 'alert-type' => 'success');
        return redirect()->route('all.categories')->with($not);
    }
}
