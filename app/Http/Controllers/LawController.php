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
        
        $data = LawQuestions::where('contest_id', $id)->orderBy('question_id', 'ASC')->get()->shuffle();
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
        $seconds = $startDate->copy()->addDays($days)->addHours($hours)->addMinutes($minutes)->diffInSeconds($endDate);

        $timeTest = Contest::findOrFail($id);

        if ($timeTest->time_test * 60 < $seconds) abort(404);
        $seconds = $timeTest->time_test * 60 - $seconds;

        return view('law.test', compact('contest', 'data', 'seconds'));
    }

    public function confirm($id, Request $request)
    {
        $contest = Contest::where('status', Contest::ENABLE)->findOrFail($id);
        if ($contest && Auth::user()->level == User::TYPE_ACCOUNT_VC_NLD && Auth::user()->status == User::ENABLE || Auth::user()->username == 'admin') {
            if (Answer::where('contest_id', $contest->id)->where('user_id', Auth::user()->id)->exists()) {
                abort(404);
            }
        } else {
            abort(404);
        }

        $dataItem = LawResult::where('contest_id', $id)->where('user_id', Auth::user()->id)->first();
        if (!empty($dataItem)) {
            return redirect()->route('contest.law', [ 'id' => $id ]);
        }

        $data = LawQuestions::where('contest_id', $id)->get();

        return view('law.confirm', compact('contest', 'data'));
    }

    public function confirmPost($id, Request $request)
    {
        $data = LawResult::where('contest_id', $id)->where('user_id', Auth::user()->id)->first();
        if (empty($data)) {
            return redirect()->route('contest.law', [ 'id' => $id ]);
        }

        return redirect()->back();
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
            $questions = LawQuestions::where('contest_id', $contestId)->get();
            foreach($data as $key => $item) {
                $explode = explode("@--@", $item);
                $question = @$explode[0];
                $answer = @$explode[1];
                $idQuestion = @$explode[2];
                
                $model = new Answer;
                $model->question_id = $idQuestion;
                $model->question_name = $question;
                if ($answer) {
                    $model->answer = $answer;
                }
                
                $model->contest_id = $contestId;
                $model->user_id = Auth::user()->id;

                foreach($questions as $value) {
                    if ($value->question_id == $idQuestion) {
                        $lower = strtolower($value->answer);
                        if ($answer == $value[$lower]) {
                            $model->result = true;
                            break;
                        }
                    }
                }

                if (Str::contains(strtolower($item), 'theo bạn nghĩ có bao nhiều người trả lời')) {
                    $model->result = Answer::PREDICT;
                }

                $model->save();
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
