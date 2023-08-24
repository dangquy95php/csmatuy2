<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;

class PermissionController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        //  $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['list','store']]);
        //  $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $data = Permission::orderBy('name','DESC')->paginate(100);

        return view('permissions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
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
            'name' => 'required|unique:permissions,name',
        ]);
    
        Permission::create(['name' => $request->input('name')]);
        Toastr::success('Tạo permission thành công!');

        return redirect()->route('permission.list');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
    
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
    
        return view('permissions.edit', compact('permission'));
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
            'name' => 'required'
        ]);
    
        try {
            $permission = Permission::find($id);
            $permission->name = trim($request->input('name'));
            $permission->save();
        } catch (\Exception $ex) {
            Toastr::error('Có lỗi hệ thống '. $ex->getMessage());
        }
        
        if ($permission->wasChanged()) {
            Toastr::success('Cập nhật permission thành công!');
        } else {
            Toastr::warning('Dữ liệu không có thay đổi');
        }
        
        return redirect()->route('permission.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::find($id)->delete();
        Toastr::success('Xóa permission thành công!');

        return redirect()->route('permission.list');
    }
}