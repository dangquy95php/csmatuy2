<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use Brian2694\Toastr\Facades\Toastr;

class ContestController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contest::with('user')->orderBy('created_at','DESC')->get();

        return view('contests.index', compact('data'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDrugAddictRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:contests,name',
            'time_test' => 'required',
            'status' => 'required',
        ]);
    
        Contest::create([
            'name' => trim($request->input('name')),
            'description' => trim($request->input('description')),
            'user_id' => Auth::user()->id,
            'time_test' => trim($request->input('time_test')),
            'status' => $request->input('status'),
            
        ]);
       
        Toastr::success('Tạo cuộc thi thành công!');

        return redirect()->route('contest.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contest = Contest::find($id);

        return view('contests.edit', compact('contest'));
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
            'time_test' => 'required',
            'status' => 'required',
        ]);

        $contest = Contest::find($id);
        $contest->name = trim($request->input('name'));
        $contest->description = trim($request->input('description'));
        $contest->time_test = trim($request->input('time_test'));
        $contest->status = $request->input('status');
        $contest->user_id = Auth::user()->id;

        $contest->save();

        if ($contest->wasChanged()) {
            Toastr::success('Cập nhật cuộc thi thành công!');
        } else {
            Toastr::warning('Dữ liệu không có thay đổi');
        }
        return redirect()->back();
    }
}