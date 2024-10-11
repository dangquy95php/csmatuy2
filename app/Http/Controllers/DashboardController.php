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

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $idContest = Contest::orderBy('created_at', 'DESC')->where('status', Contest::ENABLE)->select('id')->first();
        $checkHasAnswer = false;
        if ($idContest) {
            $checkHasAnswer = Answer::where('contest_id', $idContest->id)->where('user_id', Auth::user()->id)->exists();
        }

        return view('index', compact('idContest', 'checkHasAnswer'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Toastr::success('Đăng xuất thành công!');
        return redirect()->route('login');
    }
}
