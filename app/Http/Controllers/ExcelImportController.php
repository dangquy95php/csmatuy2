<?php

namespace App\Http\Controllers;

use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use Illuminate\Http\Request;

class ExcelImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('excel.index');
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new UserImport, $request->file('file'));
        } catch (\Exception $ex) {
            return redirect()->route('excel.index');;
        }
        return redirect()->route('user.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDrugAddictRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDrugAddictRequest $request)
    {
        //
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
}
