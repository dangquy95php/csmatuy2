<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        // $this->middleware('permission:team-index|team-create|team-edit|team-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:team-create', ['only' => ['create','store']]);
        // $this->middleware('permission:team-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:team-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Department::orderBy('name','ASC')->paginate(20);

        return view('department.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
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
            'name' => 'required|unique:departments,name',
        ]);
    
        $department = Department::create([
            'name' => trim($request->input('name')),
            'note' => trim($request->input('note')),
        ]);
       
        Toastr::success('Tạo đơn vị ngoài thành công!');

        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);

        return view('department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $department = Department::find($id);
    
        return view('department.edit', compact('department'));
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
        $department = Department::find($id);
        $department->name = trim($request->input('name'));
        $department->note = trim($request->input('note'));
        $department->save();

        if ($department->wasChanged()) {
            Toastr::success('Cập nhật đơn vị ngoài thành công!');
        } else {
            Toastr::warning('Dữ liệu không có thay đổi');
        }
        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::find($id)->delete();
        Toastr::success('Xóa đơn vị ngoài thành công!');

        return redirect()->route('department.index');
    }
}