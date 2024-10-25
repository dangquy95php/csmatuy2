<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use Carbon\Carbon;
use App\Models\Gate;
use App\Models\Team;
use App\Models\User;
use App\Models\Contest;
use App\Models\Answer;
use App\Models\LawResult;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $contest = Contest::where('status', Contest::ENABLE)->orderBy('created_at', 'DESC')->select('id', 'free_contest')->first();
        $usersExitsInLawResult = '';
        if ($contest) {
            $usersExitsInLawResult = LawResult::where('contest_id', $contest->id)->whereNotIn('user_id', json_decode($contest->free_contest))->count();
        }

        return view('index', compact('usersExitsInLawResult', 'contest'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Toastr::success('Đăng xuất thành công!');
        return redirect()->route('login');
    }
}
