<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemError;

class SystemErrorController extends Controller
{
    public function index(Request $request)
    {
        $datas = SystemError::orderBy('id', 'DESC')->paginate(20);

        return view('system-error.index', compact('datas'));
    }
}
