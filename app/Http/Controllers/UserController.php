<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\CreateUserRequest;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\User\LoginUserRequest;
use App\Models\User;
use Auth;
use Hash;

class UserController extends Controller
{
    const DISABLE = 0;
    const ENABLE = 1;

    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function postLogin(LoginUserRequest $request)
    {
        $data = [
            'username' => $request->get('username'),
            'password' => trim($request->get('password')),
            'status' => self::ENABLE,
        ];

        $remember_me = $request->has('remember') ? true : false;
        
        if (Auth::attempt($data, $remember_me)) {
            Toastr::success('Đăng nhập vào hệ thống thành công!');
            
            return redirect()->route('dashboard');
        } else {
            Toastr::error('Tên người dùng hoặc mật khẩu không chính xác!');
            return redirect()->route('login');
        }
      
        return redirect()->route('dashboard');
    }
    
    public function register(Request  $request)
    {
        return view('auth.register');
    }

    public function postRegister(CreateUserRequest  $request)
    {
        $data = [
            'name'          => $request->input('name'),
            'username'      => $request->input('username'),
            'email'         => $request->input('email'),
            'password'      => Hash::make($request->input('password')),
        ];
        try {
            User::create($data);
            Toastr::success('Tạo tài khoản '. $request->input('username') .' thành công');
        } catch(\Exception $e) {
            Toastr::success('Tạo tài khoản thất bại!'. $e->getMessage());
        }

        return redirect()->route('dashboard');
    }

    public function list(Request  $request)
    {
        return view('auth.list');
    }

    public function create(CreateUserRequest  $request)
    {
        $data = [
            'name'          => $request->input('name'),
            'username'      => $request->input('username'),
            'email'         => $request->input('email'),
            'password'      => Hash::make($request->input('password')),
        ];
        try {
            User::create($data);
            Toastr::success('Tạo tài khoản '. $request->input('username') .' thành công');
        } catch(\Exception $e) {
            Toastr::success('Tạo tài khoản thất bại!'. $e->getMessage());
        }

        return redirect()->route('dashboard');
    }
}
