<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Gate;
use App\Models\GateNote;
use Brian2694\Toastr\Facades\Toastr;

class GateController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:gate-list|gate-create|gate-edit|gate-delete', ['only' => ['index','store']]);
        $this->middleware('permission:gate-create', ['only' => ['create','store']]);
        $this->middleware('permission:gate-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:gate-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Gate::orderBy('id', 'DESC')->paginate(20);

        return view('gate.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gate.create');
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create([
            'name' => trim($request->input('name')),
            'html' => trim($request->input('html'))
        ]);
        $role->syncPermissions($request->input('permission'));
        Toastr::success('Tạo Role thành công!');

        return redirect()->route('roles.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', 'permissions.id')
            ->where('role_has_permissions.role_id',$id)
            ->get();
    
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
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
            'permission' => 'required',
        ]);
    
        $rolePermissions = DB::table('role_has_permissions')
        ->where('role_has_permissions.role_id', $id)
        ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        ->all();

        $result = array_diff($rolePermissions, $request->input('permission'));
        $result1 = array_diff($request->input('permission'), $rolePermissions);

        $role = Role::find($id);
        $role->name = trim($request->input('name'));
        $role->html = trim($request->input('html'));
        $role->save();
    
        $role->syncPermissions($request->input('permission'));

        if ($role->wasChanged() || count($result) > 0 || count($result1) > 0) {
            Toastr::success('Cập nhật Role thành công!');
        } else {
            Toastr::warning('Dữ liệu không có thay đổi');
        }
        return redirect()->route('roles.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        Toastr::success('Xóa Role thành công!');

        return redirect()->route('roles.list');
    }

    public function note()
    {
        $data = GateNote::orderBy('id', 'DESC')->paginate(20);

        return view('gate.note', compact('data'));
    }

    public function noteEdit($id)
    {
        $note = GateNote::find($id);

        return view('gate.note-edit', compact('note'));
    }

    public function noteUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
    
        $note = GateNote::find($id);
        $note->name = trim($request->input('name'));
        $note->save();

        if ($note->wasChanged()) {
            Toastr::success('Cập nhật ghi chú thành công!');
        } else {
            Toastr::warning('Dữ liệu không có thay đổi');
        }

        return redirect()->route('gate.note');
    }

    public function noteDestroy($id)
    {
        GateNote::find($id)->delete();
        Toastr::success('Xóa ghi chú thành công!');

        return redirect()->route('gate.note');
    }
}