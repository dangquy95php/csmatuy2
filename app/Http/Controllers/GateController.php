<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Gate;
use App\Models\User;
use App\Models\Team;
use App\Models\GateNote;
use App\Models\DrugAddict;
use App\Models\Department;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Storage;
use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Models\Activity;

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
        $this->middleware('permission:gate-input', ['only' => ['input']]);
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

    function noteCreate()
    {
        return view('gate.note-create');
    }

    public function noteStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:teams,name',
        ]);
    
        $team = GateNote::create([
            'name' => trim($request->input('name')),
        ]);
       
        Toastr::success('Tạo khu thành công!');

        return redirect()->route('gate.note');
    }

    public function index(Request $request)
    {
        $todayIn = Gate::with(['user', 'team', 'gate_note', 'auth'])->whereDate('created_at', Carbon::today())->whereNotNull('staff_in')->paginate(20);
        $listIdUser = Gate::whereDate('created_at', Carbon::today())->whereNotNull('staff_in')->pluck('user_id')->toArray();

        $listNotYetIn = User::whereNotNull('team_id')->where('status', User::ENABLE)
        ->whereNotIn('users.id', $listIdUser)->rightJoin('teams', function($join) {
            $join->on('users.team_id', '=', 'teams.id')->where('type', Team::OFFICE_HOUR);
        })->get();

        return view('gate.index', compact('todayIn', 'listNotYetIn'));
    }

    public function input(Request $request)
    {
        $gateNote = GateNote::all();
        $userByArea = Team::with(['user'])->orderBy('type', 'desc')->get();
        $search = $request->input('search');

        if ($request->input('search')) {
            $ids = User::where('first_name', 'like', "%$search%")->pluck('id')->toArray();
            $dataCountReqest = Gate::whereIn('user_id', $ids)->pluck('count_request')->toArray();
            $dataGate = Gate::orderByID()->where(function ($query) {
                $query->whereDate('created_at', \Carbon\Carbon::today());
            })->whereIn('count_request', $dataCountReqest)->where(function ($query) {
                $query->where('staff_out', '=', null)
                      ->orWhere('staff_in', '=', null);
            })->take(500)->get()->groupBy('count_request');
        } else {
            $dataGate = Gate::orderByID()->where(function ($query) {
                $query->whereDate('created_at', \Carbon\Carbon::today());
            })->where(function ($query) {
                $query->where('staff_out', '=', null)
                      ->orWhere('staff_in', '=', null);
            })->take(500)->get()->groupBy('count_request');
        }

        $dataEmployer = [];
        foreach ($userByArea as $key => $items) {
            $object = new \stdClass();
            $object->text = $items->name;
            $object->id = $items->id;
            $object->children = [];
            foreach($items->user as $item) {
                $objectChild = new \stdClass();
                $objectChild->text =  $item->last_name .' '. $item->first_name;
                $objectChild->id = $item->id;
                $objectChild->first_name = $item->first_name;
                $objectChild->title = $item->last_name .' '. $item->first_name;
                $objectChild->area = $items->name;
                $objectChild->area_id = $items->id;
               
                array_push($object->children, $objectChild);
            }
            array_push($dataEmployer, $object);
        }
        
        return view('gate.input', compact('gateNote', 'dataEmployer', 'dataGate'));
    }
    
    public function end(Request $request)
    {
        $id = $request->input('count_request');
        $dataUpdate = [];
       
        if (empty($request->input('staff_out'))) {
            $dataUpdate['staff_out'] = \Carbon\Carbon::now()->format('H:i:s');
        } else {
            $dataUpdate['staff_out'] = $request->input('staff_out');
        }
        if (empty($request->input('staff_in'))) {
            $dataUpdate['staff_in'] = \Carbon\Carbon::now()->format('H:i:s');
        } else {
            $dataUpdate['staff_in'] = $request->input('staff_in');
        }

        try {
            $gate = Gate::where('count_request', $id)->update($dataUpdate);

        } catch (\Exception $ex) {
            return response()->json(['message' => 'Có lỗi đã xảy ra!'. $ex->getMessage()], 500);
        }

        return response()->json(['message' => 'Kết thúc thành công'], 200);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'gate_note_id' => 'required',
        ], [
            'gate_note_id.required' => 'Công việc bắt buộc chọn',
        ]);

        if (empty($request->input('staff_out')) && empty($request->input('staff_in'))) {
            throw ValidationException::withMessages(['staff' => 'Chưa có thời gian ra hoặc vào']);
        }

        $id = $request->input('count_request');
        $dataUpdate = [];
       
        $dataUpdate['student_out'] = $request->input('student_out');
        $dataUpdate['student_in'] = $request->input('student_in');
        $dataUpdate['note'] = $request->input('note');
        $dataUpdate['gate_note_id'] = $request->input('gate_note_id');

        if($request->input('staff_in')) {
            $dataUpdate['staff_in'] = $request->input('staff_in');
        }
        if($request->input('staff_out')) {
            $dataUpdate['staff_out'] = $request->input('staff_out');
        }
        try {
            $gate = Gate::where('count_request', $id)->firstOrFail()->update($dataUpdate);
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Có lỗi đã xảy ra!'. $ex->getMessage()], 500);
        }

        return response()->json(['message' => 'Cập nhật thành công'], 200);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'employers' => 'required',
            'gate_note_id' => 'required',
        ], [
            'employers.required' => 'Tên bắt buộc nhập',
            'gate_note_id.required' => 'Công việc bắt buộc chọn',
        ]);

        if (empty($request->input('staff_out')) && empty($request->input('staff_in'))) {
            throw ValidationException::withMessages(['staff' => 'Chưa có thời gian ra hoặc vào']);
        }

        $id = 1;
        $record = Gate::orderBy('count_request', 'DESC')->orderBy('created_at', 'DESC')->select('count_request')->first();

        try {
            foreach($request->input('employers') as $item) {
                if (!empty($record)) {
                    $id = $record->count_request + 1;
                }

                $gate['team_id'] = $item['team_id'];
                $gate['user_id'] =  $item['user_id'];

                if($request->input('staff_out')) {
                    $gate['staff_out'] =  $request->input('staff_out');
                }

                if($request->input('staff_in')) {
                    $gate['staff_in'] =   $request->input('staff_in');
                }

                if($request->input('student_out')) {
                    $gate['student_out'] =  $request->input('student_out');
                }
                
                if($request->input('student_in')) {
                    $gate['student_in'] =  $request->input('student_in');
                }

                if($request->input('note')) {
                    $gate['note'] =  trim($request->input('note'));
                }

                if($request->input('gate_note_id')) {
                    $gate['gate_note_id'] = $request->input('gate_note_id');
                }

                $gate['count_request'] = $id;
                $gate['auth_id']       = Auth::id();

                $data = Gate::create($gate);
            }
        } catch (\Exception $ex) {
            return response()->json(['message' => 'Có lỗi đã xảy ra!'. $ex->getMessage()], 500);
        }

        return response()->json(['message' => 'Thêm thành công', 'data' => $data], 200);
    }
}