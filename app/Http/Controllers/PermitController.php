<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Permit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Auth;
use Image;

class PermitController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:permit-list', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        $data = Permit::with('user')->paginate(20);

        return view('permits.index', compact('data'));
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
            'image' => 'required|mimes:jpeg,jpg,png,gif|required|max:2048',
        ],[
          'image.required' => 'Vui lòng chọn hình ảnh',
          'image.mimes' => 'Có lỗi đã xảy ra!',
        ]);

        $model = new Permit();
        $unix_timestamp = now()->timestamp;
        $fileName = Auth::user()->username . '_' . $unix_timestamp;
        $file = $request->file('image'); // Retrieve the uploaded file from the request

        $img = Image::make($file);
        $img->resize(700, 700, function ($constraint) {
            $constraint->aspectRatio();                 
        });
        $img->stream();

        Storage::disk('local')->put('public/permit/'. $fileName .'_'. $file->getClientOriginalName(), $img);
        
        $model->image = $fileName .'_'. $file->getClientOriginalName();
        $model->user_id = Auth::user()->id;
        $model->save();
        
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
    public function destroy(Request $request)
    {       
        $data = Permit::paginate(20);

        return view('permits.index', compact('data'));
    }
}