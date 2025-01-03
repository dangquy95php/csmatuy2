<?php

namespace App\Http\Controllers;

use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ExcelImportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:excel-import', ['only' => ['import','postImport']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('excel.index');
    }

    public function postImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|max:2000',
        ], [
            'file.required' => 'Tập tin chưa được chọn',
            'file.max' => 'Tập tin dung lượng quá lớn'
        ]);

        \DB::beginTransaction();
        try {
            Excel::queueImport(new UserImport, $request->file('file'));
            \DB::commit();
        } catch (\Exception $ex) {
            \DB::rollback();
            Toastr::error('Import excel thất bại!'. $ex->getMessage());
            return redirect()->route('excel.import');
        }
        Toastr::success('Import dữ liệu thành công!');
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
