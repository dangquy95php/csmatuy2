<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Auth;
use Image;

class LogController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:log-list', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        $data = Log::with('user')->orderBy('created_at','desc')->paginate(20);

        return view('log.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {       
        return view('permits.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $this->validate($request, [
            'file' => 'required|file:2048|mimes:csv,xlsx,xls',
        ],[
          'file.required' => 'Vui lòng chọn hình ảnh',
          'file.mimes' => 'Có lỗi đã xảy ra!',
          'file.in' => 'Có lỗi đã xảy ra!',
        ]);

        $model = new Permit();
        $unix_timestamp = now()->timestamp;
        $fileName = Auth::user()->username . '_' . $unix_timestamp;
        $file = $request->file('file'); // Retrieve the uploaded file from the request

        Storage::disk('local')->put('public/permit/'. $fileName .'_'. $file->getClientOriginalName(), file_get_contents($file));
        
        $model->name_file = $fileName .'_'. $file->getClientOriginalName();
        $model->user_id = Auth::user()->id;
        $model->note = $request->get('note');

        $model->save();
        Toastr::success('Tải tập tin lên thành công!');

        return redirect()->route('permit.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {       
        $data = Permit::paginate(20);

        return view('permits.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {       
        $data = Permit::paginate(20);

        return view('permits.index', compact('data'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        Permit::find($id)->delete();

        return redirect()->route('permit.index');
    }
}