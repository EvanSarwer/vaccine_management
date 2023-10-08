<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //

    public function index(){
        return view('main.index');
    }

    public function signin(){
        return view('user.signin');
    }

    public function signup(){
        return view('user.signup');
    }
}
