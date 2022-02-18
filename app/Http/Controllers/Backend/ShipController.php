<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\District;
use App\Models\State;

class ShipController extends Controller
{
    public function ManageShipping()
    {
        $shippings = Shipping::orderBy('id', 'DESC')->get();
        return view('backend.ship.view', compact('shippings'));
    }

    public function StoreArea(Request $request)
    {
        Shipping::create([
            'division_area' => $request->division_area,
        ]);

        $not = array(
            'message' => 'Your producd has been deleted',
            'alert-type' => 'danger',
        );

        return redirect()->back()->with($not);
    }

    public function ShipEdit($id)
    {
        $edits = Shipping::find($id);
        return view('backend.ship.edit', compact('edits'));
    }

    public function UpdateShipping(Request $request, $id)
    {
        Shipping::find($id)->update([
            'division_area' => $request->division_area,
        ]);


        return redirect()->route('manage-ship');
    }


    public function ShipDelete($id)
    {
        Shipping::find($id)->delete();
        return redirect()->route('manage-ship');
    }

    public function ManageDistrict()
    {
        $divisions = Shipping::orderBy('id', 'DESC')->get();
        $districts = District::with('division')->orderBy('id', 'DESC')->get();

        return view('backend.district.view', compact('divisions', 'districts'));
    }

    public function StoreDistrict(Request $request)
    {
        District::create([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

        return redirect()->route('manage-district');
    }

    public function DistrictEdit($id)
    {
        $diss = District::find($id);
        $divs = Shipping::orderBy('id', 'DESC')->get();
        return view('backend.district.edit', compact('diss', 'divs'));
    }

    public function UpdateDistrict(Request $request, $id)
    {
        District::find($id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);


        return redirect()->route('manage-district');
    }


    public function DistrictDelete($id)
    {
        District::find($id)->delete();
        return redirect()->back();
    }

    public function ManageState()
    {
        $divisions = Shipping::orderBy('id', 'DESC')->get();
        $districts = District::orderBy('id', 'DESC')->get();
        $states = State::with('division', 'district')->orderBy('id', 'DESC')->get();

        return view('backend.state.view', compact('divisions', 'districts', 'states'));
    }

    public function AjaxState($id)
    {
        $diss = District::where('division_id', $id)->get();
        return response()->json($diss);
    }


    public function StoreState(Request $request)
    {
        State::create([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

        return redirect()->route('manage-state');
    }

    public function StateEdit($id)
    {
        $divisions = Shipping::orderBy('id', 'DESC')->get();
        $districts = District::orderBy('id', 'DESC')->get();
        $state = State::find($id);

        return view('backend.state.edit', compact('state', 'divisions', 'districts'));
    }

    public function UpdateState(Request $request, $id)
    {
        State::find($id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' =>  $request->state_name,
        ]);


        return redirect()->route('manage-state');
    }


    public function StateDelete($id)
    {
        State::find($id)->delete();
        return redirect()->route('manage-state');
    }
}
