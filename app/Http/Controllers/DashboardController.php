<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use Carbon\Carbon;
use App\Models\Gate;
use App\Models\Team;
use App\Models\User;

class DashboardController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:user-list', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $gateIDUsers = Gate::whereDate('gates.created_at', Carbon::today())
                        ->join('teams', 'teams.id', '=', 'gates.team_id')
                        ->where('teams.type', Team::OFFICE_HOUR)->pluck('user_id');

        $datas = User::
            join('teams', 'teams.id', '=', 'users.team_id')
            ->where('teams.type', '=', Team::OFFICE_HOUR)
            ->select('users.first_name', 'users.last_name', 'users.email', 'users.image', 'users.team_id')
            ->whereNotIn('users.id', $gateIDUsers)->paginate(10);

        return view('index', compact('datas'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Toastr::success('Đăng xuất thành công!');
        return redirect()->route('login');
    }
}