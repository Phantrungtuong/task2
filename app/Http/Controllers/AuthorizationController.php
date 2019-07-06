<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getauthor(){
        return view('admin.index');
    }
}
