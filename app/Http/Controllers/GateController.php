<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Gate;
use App\Models\Team;
use App\Models\GateNote;
use App\Models\DrugAddict;
use App\Models\GuestStudents;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Storage;
use Auth;

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
        $this->middleware('permission:gate-create-staff', ['only' => ['createStaff']]);
        $this->middleware('permission:gate-guest-student', ['only' => ['guestStudent']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        $gate = '';
        if (is_null($request->get('type_gate'))) {
            $gate = Gate::ALL;
        } else {
            $gate = $request->get('type_gate');
        }

        if (($request->get('staff_start_date') && $request->get('staff_end_date')) && empty($request->get('staff_today'))) {
            $data = Gate::typeGate($gate)->startDate($request->get('staff_start_date'))
                        ->endDate($request->get('staff_end_date'))
                        ->orderByID()->with(['user', 'team'])->get();
        } elseif($request->get('staff_today')) {
            $data = Gate::typeGate($gate)->today()->orderByID()->with(['user', 'team'])->get();
        } else {
            $data = Gate::typeGate($gate)->orderByID()->with(['user', 'team'])->get();
        }
  
        $dataGroup = $data->groupBy('count_request');
        foreach($dataGroup as $key => &$datas) {
            if (count($datas) > 0) {
                $datas[0]->rowspan = count($datas);
            }
        }
        // $dataGroup = $data;
        $data = $dataGroup->paginate(20);

        $drugAddict = DrugAddict::orderBy('id', 'DESC')->paginate(20);
        $guestStudent = GuestStudents::orderBy('id', 'DESC')->paginate(20);
        
        return view('gate.index', compact('data', 'drugAddict', 'guestStudent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gateNote = GateNote::all();
        $teams    = Team::with('user')->orderBy('name','ASC')->get();
        // $copyData = $teams;

        // foreach ($copyData as $key => $team) {
        //     foreach ($team->user as &$value) {
               
        //         $value->id_area = $team->id;
        //     }
        // }
        $dataTeamAndEmployer = [];

        foreach ($teams as $items) {
            $data = [];
            foreach ($items->user as $value) {
                $nameFile = '';
                if (file_exists('storage/profile/'. $value->image)) {
                    $nameFile = $value->image;
                } else {
                    $nameFile = 'default.jpg';
                }

                $object = new \stdClass;
                $object->id = $value->id .'_'. $items->id;
                $object->text = $value->name;
                $object->image = $nameFile;
                $object->team_id = $items->name;

                array_push($data, $object);
            }

            $objectTotal = new \stdClass;
            $objectTotal->children = $data;
            $objectTotal->id = $items->id;
            $objectTotal->text = $items->name;

            array_push($dataTeamAndEmployer, $objectTotal);
        }

        return view('gate.create', compact('gateNote', 'teams', 'dataTeamAndEmployer'));
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

    function noteCreate()
    {
        return view('gate.note-create');
    }

    public function noteStore(Request $request)
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

    public function createStaff(Request $request)
    {
        $this->validate($request, [
            'staff' => 'required',
            'time' => 'required',
        ], [
            'staff.required'=> 'Chọn tên nhân viên',
            'time.required'=> 'Xin vui lòng chọn thời gian',
        ]);

        try {
            $users = $request->get('staff');
            $record = Gate::orderBy('count_request', 'DESC')->select('count_request')->first();
            $id = 1;

            if (!empty($record)) {
                $id = $record->count_request + 1;
            }

            foreach ($users as $key => $user) {
                $idUserAndDepartment = explode('_', $user);

                $gate = new Gate();
                $gate->user_id = @$idUserAndDepartment[0];
                $gate->team_id = @$idUserAndDepartment[1];
                $gate->count_request = $id;
                $gate->auth_id = Auth::id();
                
                if($request->has('number_of_drug_addicts')) {
                    $gate->number_of_drug_addicts =  $request->get('number_of_drug_addicts');
                }
                if($request->has('note')) {
                    $gate->note = $request->get('note');
                }
                if($request->has('type_gate')) {
                    $gate->type_gate = $request->get('type_gate');
                }
                if($request->has('time')) {
                    $gate->created_at = $request->get('time');
                }
            
                $gate->save();
            }
        } catch (\Exception $ex) {
            Toastr::error('Tạo vé thất bại'. $ex->getMessage());
            return redirect()->back();
        }
        Toastr::success('Tạo phiếu thành công!');

        return redirect()->route('gate.index');
    }

    public function relativesOfDrugAddicts(Request $request)
    {
        $rules = [
            "personal_name"    => "required|array|min:1",
            'personal_name.*'  => 'required|string|distinct|min:1',
            'time1' => 'required',
        ];
        $messages = [
            'time1.required'=> 'Xin vui lòng chọn thời gian',
            'personal_name.*.required' => 'Vui lòng nhập tên thân nhân',
            'personal_name.*.min' => 'Vui lòng nhập ít nhất 1 người thân nhân',
            'personal_name.*.distinct' => 'Người thân nhân đã bị trùng tên',
        ];
        if ($request->get('type_gate') == 1) {
            $rules = array_merge($rules, [
                'name_of_drug_addict' => 'required|array|min:1',
                'name_of_drug_addict.*' => 'required|string|distinct|min:1',
            ]);
            $messages = array_merge($messages, [
                'name_of_drug_addict.*.required' => 'Vui lòng nhập tên người cai nghiện',
                'name_of_drug_addict.*.min' => 'Vui lòng nhập ít nhất 1 người cai nghiện',
                'name_of_drug_addict.*.distinct' => 'Người cai nghiện đã bị trùng tên',
            ]);
        }

        $this->validate($request, $rules, $messages);
        $personalName = implode(",", $request->get('personal_name'));

        try {
            $drugAddict = new DrugAddict();
            $drugAddict->personal_name = $personalName;
            $drugAddict->note = $request->get('note1');
            $drugAddict->type_gate = $request->get('type_gate');
            $drugAddict->kind_of_detox = $request->get('kind_of_detox');
            $drugAddict->car_number = $request->get('car_number');
            $drugAddict->auth_id = Auth::id();
            if ($request->get('name_of_drug_addict')) {
                $nameAddict = implode(",", $request->get('name_of_drug_addict'));
                $drugAddict->name_of_drug_addict =  $nameAddict;
            }
            $drugAddict->created_at = $request->get('time1');

            $drugAddict->save();
        } catch (\Exception $ex) {
            Toastr::error('Tạo vé người thân của người cai nghiện đưa lên thất bại '. $ex->getMessage());
            return redirect()->back();
        }
        Toastr::success('Tạo phiếu thành công!');

        return redirect()->route('gate.index', ['tab' => 'tab2']);
    }

    public function guestStudent(Request $request)
    {
        $this->validate($request, [
            'staff_name' => 'required',
            'time2' => 'required',
        ], [
            'staff_name.required'=> 'Chọn tên nhân viên',
            'time2.required'=> 'Xin vui lòng chọn thời gian',
        ]);

        $guestStudent = new GuestStudents();
        $guestStudent->staff_name = $request->get('staff_name');
        $guestStudent->car_number = $request->get('car_number');
        $guestStudent->number_of_drug_addicts = $request->get('number_of_drug_addicts1');
        $guestStudent->type_gate = $request->get('type_gate');
        $guestStudent->note = $request->get('note2');
        $guestStudent->auth_id = Auth::id();
        $guestStudent->created_at = $request->get('time2');

        $guestStudent->save();

        return redirect()->route('gate.index', ['tab' => 'tab3']);
    }
}