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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function law($id, Request $request)
    {
        $contest = Contest::where('status', Contest::ENABLE)->findOrFail($id);
        if ($contest && Auth::user()->level == User::TYPE_ACCOUNT_VC_NLD && Auth::user()->status == User::ENABLE || Auth::user()->username == 'admin') {
            if (Answer::where('contest_id', $contest->id)->where('user_id', Auth::user()->id)->exists()) {
                abort(404);
            }
        } else {
            abort(404);
        }
        
        $data = LawQuestions::where('contest_id', $id)->get()->shuffle();
        $now = Carbon::now();
        $resultLaw = LawResult::where('contest_id', $id)->where('user_id', Auth::user()->id)->first();
        
        if (empty($resultLaw)) {
            $resultLaw = LawResult::create([
                'contest_id' => $id,
                'time_start' => $now,
                'user_id'    => Auth::user()->id,
                'time_to_do_the_test' => count($data),
            ]);
        }
        $startDate = Carbon::createFromFormat('d-m-Y H:i:s', Carbon::parse($now)->format('d-m-Y H:i:s'));
        $endDate = Carbon::createFromFormat('d-m-Y H:i:s', Carbon::parse($resultLaw->time_start)->format('d-m-Y H:i:s'));
        
        $days = $startDate->diffInDays($endDate);
        $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
        $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);

        $timeTest = Contest::findOrFail($id);
        $minutes = $timeTest->time_test - $minutes;

        return view('law.test', compact('contest', 'data', 'minutes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lawPost($contestId, Request $request)
    {
        try {
            $data = $request->input('data');
            $id = 1;
            foreach($data as $key => $item) {
                $explode = explode("@--@", $item);
                $question = @$explode[0];
                $answer = @$explode[1];
                
                $model = new Answer;
                $model->question_id = $id;
                $model->question_name = base64_encode($question);
                if ($answer) {
                    $model->answer = base64_encode($answer);
                }
                
                $model->contest_id = $contestId;
                $model->user_id = Auth::user()->id;
                $model->save();
                $id++;
            }
            $now = Carbon::now();
            LawResult::where('contest_id', $contestId)->where('user_id', Auth::user()->id)->update(['time_end' => $now]);
        } catch (\Exception $ex) {
            Toastr::error('Có lỗi '. $ex->getMessage());
            return redirect()->back();
        }
        
        Toastr::success('Bạn đã nộp bài thi! Vui lòng đợi kết quả công bố sau.');

        return redirect()->route('dashboard');
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
    
                $model->question_name = base64_encode($item['question_name']);
                $model->question_id = $item['question_id'];
                $model->contest_id = $contestId;
                $model->a = base64_encode($item['a']);
                $model->b = base64_encode($item['b']);
                $model->c = base64_encode($item['c']);
                $model->d = base64_encode($item['d']);
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
    
                $model->question_name = base64_encode($item['question_name']);
                $model->question_id = $item['question_id'];
                $model->contest_id = $id;
                $model->a = base64_encode($item['a']);
                $model->b = base64_encode($item['b']);
                $model->c = base64_encode($item['c']);
                $model->d = base64_encode($item['d']);
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
}
