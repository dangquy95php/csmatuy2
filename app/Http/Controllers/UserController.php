<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\CreateUserRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['list','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $data = User::all();
        
        foreach ($data as &$user) {
            $user->user_role = $user->roles->pluck('name', 'name')->all();
        }

        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();

        return view('users.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required_with:password_confirmation|same:password_confirmation',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = trim($input['password']);
        try {
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
            Toastr::success('Tạo người dùng thành công!');
        } catch (\Exception $ex) {
            Toastr::error('Tạo người dùng thất bại '. $ex->getMessage());
        }
        
        return redirect()->route('user.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
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
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required_with:password_confirmation|same:password_confirmation',
            'roles' => 'required'
        ]);
       
        $input = $request->all();

        if(!empty($input['password'])) { 
            $input['password'] = trim($input['password']);
        } else {
            $input = Arr::except($input, array('password'));    
        }

        $user = User::find($id);
        $userRole = $user->roles->pluck('name')->all();
        $result = array_diff($userRole, $request->input('roles'));
        $result1 = array_diff($request->input('roles'), $userRole);

        $user->update($input);

        DB::table('model_has_roles')
            ->where('model_id', $id)
            ->delete();
    
        $user->assignRole($request->input('roles'));
       
        $result = array_diff($userRole, $request->input('roles'));

        if (count($user->getChanges()) > 0 || count($result) > 0 || count($result1) > 0) {
            $user->update(['is_account_enabled' => false]);
            Toastr::success('Cập nhật người dùng thành công!');
        } else {
            Toastr::warning('Dữ liệu không có thay đổi');
        }

        return redirect()->route('user.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('users.list')
            ->with('success', 'User deleted successfully.');
    }
}