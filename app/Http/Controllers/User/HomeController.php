<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    function __construct()
    {
        
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('user.profile');
        } else {
            return redirect()->route('login');
        }
    }
}