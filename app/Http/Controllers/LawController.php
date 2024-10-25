<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Contest;
use App\Models\User;
use App\Models\Answer;
use App\Models\LawResult;
use App\Models\LawQuestions;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LawController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:law-index|law-create|law-edit|law-delete', ['only' => ['index','store']]);
        $this->middleware('permission:law-create', ['only' => ['create','store']]);
        $this->middleware('permission:law-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:law-delete', ['only' => ['destroy']]);
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

    public function createQuestion($id, Request $request)
    {
        $data = LawQuestions::where('contest_id', $id)->get();

        return view('law.question.create', compact('data'));
    }

    public function createQuestionStore($id, Request $request)
    {
        $data = $request->input('data');
        Contest::findOrFail($id);
        $contestId = $id;

        try {
            foreach($data as $item) {
                $model = new LawQuestions;
    
                $model->question_name = $item['question_name'];
                $model->question_id = $item['question_id'];
                $model->contest_id = $contestId;
                $model->a = $item['a'];
                $model->b = $item['b'];
                $model->c = $item['c'];
                $model->d = $item['d'];
                $model->random = $item['random'];
                $model->point = $item['point'];
                $model->answer = $item['answer'];
    
                $model->save();
            }
        } catch (\Exception $ex) {
            Toastr::error('Có lỗi '. $ex->getMessage());
            return redirect()->back();
        }
       
        Toastr::success('Tạo câu hỏi thành công!');

        return redirect()->route('contest.index');
    }

    public function updateQuestion($id, Request $request)
    {
        $data = $request->input('data');
        Contest::findOrFail($id);
        try {
            LawQuestions::where('contest_id','=', $id)->delete();

            foreach($data as $item) {
                $model = new LawQuestions;
    
                $model->question_name = $item['question_name'];
                $model->question_id = $item['question_id'];
                $model->contest_id = $id;
                $model->a = $item['a'];
                $model->b = $item['b'];
                $model->c = $item['c'];
                $model->d = $item['d'];
                $model->random = $item['random'];
                $model->point = $item['point'];
                $model->answer = $item['answer'];
    
                $model->save();
            }
        } catch (\Exception $ex) {
            Toastr::error('Có lỗi '. $ex->getMessage());
            return redirect()->back();
        }
    
        Toastr::success('Cập nhật câu hỏi thành công!');
        return redirect()->back();
    }

    public function question($id, Request $request)
    {
        $listQuestion = LawQuestions::where('contest_id', $id)->get();
        $contest = Contest::where('status', Contest::ENABLE)->findOrFail($id);

        return view('law.question.index', compact('contest', 'listQuestion'));
    }
}
