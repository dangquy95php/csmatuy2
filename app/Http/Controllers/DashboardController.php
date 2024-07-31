<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use Carbon\Carbon;
use App\Models\Gate;


class DashboardController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:user-list', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $timeNow = Carbon::now();
        // dd($timeNow);
        // $data = Gate::with('team')->whereDate('created_at', Carbon::today())->get();

        $data = Gate::with(['team' => fn($query) => $query->where('type', '=', 2)])->whereDate('created_at', Carbon::today())->get();


        return view('index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Toastr::success('Đăng xuất thành công!');
        return redirect()->route('login');
    }
}