<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Team;

class TeamController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:team-index|team-create|team-edit|team-delete', ['only' => ['index','store']]);
        $this->middleware('permission:team-create', ['only' => ['create','store']]);
        $this->middleware('permission:team-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:team-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Team::orderBy('name','ASC')->paginate(20);

        return view('teams.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:teams,name',
        ]);
    
        $team = Team::create([
            'name' => trim($request->input('name')),
        ]);
       
        Toastr::success('Tạo khu thành công!');

        return redirect()->route('team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);

        return view('team.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $team = Team::find($id);
    
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $team = Team::find($id);
        $team->name = trim($request->input('name'));
        $team->save();

        if ($team->wasChanged()) {
            Toastr::success('Cập nhật phòng/khu thành công!');
        } else {
            Toastr::warning('Dữ liệu không có thay đổi');
        }
        return redirect()->route('team.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Team::find($id)->delete();
        Toastr::success('Xóa phòng/khu thành công!');

        return redirect()->route('team.index');
    }
}