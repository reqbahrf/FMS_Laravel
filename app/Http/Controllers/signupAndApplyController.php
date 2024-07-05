<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class signupAndApplyController extends Controller
{
    public function signup(){
        return view('registerpage.signup');
    }

    public function applicationform(){
        return view('registerpage.application');
    }

}
