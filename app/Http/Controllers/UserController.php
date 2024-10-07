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
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function export()
    {
        $time = date('Y-m-d H:i:s');
        $time = str_replace(':', '_', $time);
        $time = str_replace(' ', '_', $time);

        return Excel::download(new UserExport, $time . 'danh-sach-vien-chuc-nld.xlsx');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        if (!empty($request->input('search'))) {
            $search = $request->input('search');;
            $data = User::where('name', 'like', "%$search%")->with(['team', 'user_infor'])->paginate(20);
        } else {
            $data = User::with(['team', 'user_infor'])->whereNotNull('team_id')->paginate(20);
        }
        
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
            'first_name' => 'required',
            'last_name' => 'required',
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
        Toastr::success('Xóa người dùng thành công!');

        return redirect()->route('user.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        $isHasData = false;
        if (empty($user->email) || empty($user->image)) {
            $isHasData = true;
        }

        return view('users.profile', compact('isHasData'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postProfile(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            if ($request->file('image')) {
                $unix_timestamp = now()->timestamp;
                $fileName = Auth::user()->username . '_' . $unix_timestamp;
                $file = $request->file('image'); // Retrieve the uploaded file from the request
                Storage::disk('local')->put('public/profile/'. $fileName .'_'. $file->getClientOriginalName(), file_get_contents($file));
                
                $user = auth()->user();
                $user->image = $fileName .'_'. $file->getClientOriginalName();
            }
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->save();
    
            if ($user->wasChanged()) {
                Toastr::success('Cập nhật thông tin cá nhân thành công!');
            } else {
                Toastr::warning('Dữ liệu không có thay đổi');
            }
        } catch (\Exception $ex) {
            Toastr::error('Cập nhật thất bại '. $ex->getMessage());
            return redirect()->back();
        }

        return redirect()->back();
    }
}