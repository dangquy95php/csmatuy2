<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\Models\User;
use App\Models\Team;
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
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['list','store']]);
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
        $data = User::with('team')->get();
        
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
        $teams = Team::select('id', 'name')->get();

        return view('users.create', compact('roles', 'teams'));
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
            'username' => 'required|alpha_dash|unique:users,username',
            'password' => 'required',
            'team_id' => 'required',
            'roles' => 'required',
        ]);
    
        $input = $request->all();
        $input['password'] = $input['password'];
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('user.list')
            ->with('success', 'User created successfully.');
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
        }

        Toastr::success('Cập nhật người dùng thành công!');

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

        return redirect()->route('user.list')
            ->with('success', 'User deleted successfully.');
    }
}