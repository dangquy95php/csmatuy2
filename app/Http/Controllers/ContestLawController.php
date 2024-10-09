<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Contest;

class ContestLawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function law()
    {
        return view('law.question.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contest::with('user')->orderBy('name','ASC')->get();

        return view('law.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('law.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDrugAddictRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:teams,name',
        ]);
    
        Contest::create([
            'name' => trim($request->input('name')),
            'description' => trim($request->input('description')),
            'user_id' => Auth::user()->id,
        ]);
       
        Toastr::success('Tạo cuộc thi thành công!');

        return redirect()->route('contest.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrugAddict  $drugAddict
     * @return \Illuminate\Http\Response
     */
    public function show(DrugAddict $drugAddict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DrugAddict  $drugAddict
     * @return \Illuminate\Http\Response
     */
    public function edit(DrugAddict $drugAddict)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDrugAddictRequest  $request
     * @param  \App\Models\DrugAddict  $drugAddict
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDrugAddictRequest $request, DrugAddict $drugAddict)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrugAddict  $drugAddict
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugAddict $drugAddict)
    {
        //
    }

    public function createQuestion(Request $request)
    {
        return view('law.question.create');
    }
}
