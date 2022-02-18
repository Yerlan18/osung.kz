<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{

    public function AdminProfile()
    {
        $adminData = Admin::find(1);
        return view('admin.admin_profile', compact('adminData'));
    }

    public function AdminProfileEdit()
    {
        $adminData = Admin::find(1);
        return view('admin.admin_profileEdit', compact('adminData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $data = Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->file('file')) {
            $file = $request->file('file');
            @unlink(public_path('upload/admin_images/' . $request->profile_photo_path));
            $name = hexdec(uniqid());
            $ext = strtolower($file->getClientOriginalExtension());
            $fname = $name . '.' . $ext;
            $path = 'upload/admin_images/';
            $file->move(public_path($path), $fname);
            $data['profile_photo_path'] = $fname;
            $data->save();
        }
        $notification = ['message' => 'Admin info has been changed', 'alert-type' => 'success'];

        return redirect()->route('admin.profile')->with($notification);
    }


    public function ChangePassword()
    {
        return view('admin.admin_change_password');
    }


    public function UpdatePassword(Request $request)
    {

        $val = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);



        $hashedPassword = Admin::find(1)->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        } else {
            return redirect()->back();
        }
    }
}
