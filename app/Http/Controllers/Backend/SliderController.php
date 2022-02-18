<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function ViewSlider()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));
    }



    public function SliderStore(Request $request)
    {

        $not = [
            'message' => 'Slider has been added',
            'alert-type' => 'success'
        ];


        if ($request->file('slider_img')) {
            $hid = hexdec(uniqid());
            $file = $request->file('slider_img');
            $ext = $file->getClientOriginalExtension();
            $fName = $hid . '.' . $ext;
            $path = 'upload/slider_images/';
            $db = $path . $fName;
            $file->move(public_path($path), $fName);
            Slider::create([
                'title' => $request->title,
                'description' => $request->description,
                'slider_img' => $db,
            ]);

            return redirect()->back()->with($not);
        }
    }

    public function SliderUpdate($id)
    {
        $sliders = Slider::FindOrFail($id);
        return view('backend.slider.slider_edit', compact('sliders'));
    }

    public function SSLUpdate(Request $request)
    {
        $not = [
            'message' => 'Slider has been added',
            'alert-type' => 'success'
        ];

        $slider_id = $request->id;
        $oldimg = $request->old_img;

        if ($request->file('slider_img')) {
            unlink($oldimg);
            $hid = hexdec(uniqid());
            $file = $request->file('slider_img');
            $ext = $file->getClientOriginalExtension();
            $fName = $hid . '.' . $ext;
            $path = 'upload/slider_images/';
            $db = $path . $fName;
            $file->move(public_path($path), $fName);
            Slider::FindOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'slider_img' => $db,
            ]);

            return redirect()->back()->with($not);
        } else {
            Slider::FindOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return redirect()->back()->with($not);
        }
    }


    public function DeleteSlider($id)
    {
        $old = Slider::find($id)->slider_img;
        unlink($old);

        Slider::FindOrFail($id)->delete();

        return redirect()->back();
    }



    public function SliderInactive($id)
    {
        SLider::FindOrFail($id)->update(['status' => 0]);
        return redirect()->back();
    }

    public function SliderActive($id)
    {
        SLider::FindOrFail($id)->update(['status' => 1]);
        return redirect()->back();
    }
}
