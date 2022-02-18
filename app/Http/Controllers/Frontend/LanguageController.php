<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function Ru()
    {
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'rus');
        return redirect()->back();
    }

    public function Eng()
    {
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'eng');
        return redirect()->back();
    }
}
