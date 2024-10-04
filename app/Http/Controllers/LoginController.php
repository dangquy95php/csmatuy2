<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\LoginUserRequest;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    function __construct()
    {
        
    }

    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function postLogin(LoginUserRequest $request)
    {
        $data = [
            'username' => $request->get('username'),
            'password' => trim($request->get('password')),
            'status' => User::ENABLE,
        ];

        $remember_me = $request->has('remember') ? true : false;

        if (Auth::attempt($data, $remember_me)) {
            Toastr::success('Đăng nhập vào hệ thống thành công!');

            return redirect()->route('dashboard');
        } else {
            Toastr::error('Tên người dùng hoặc mật khẩu không chính xác!');
            return redirect()->back()->withInput();
        }
      
        return redirect()->route('dashboard');
    }
}