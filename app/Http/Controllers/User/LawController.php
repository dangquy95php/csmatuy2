<?php

namespace App\Http\Controllers\User;

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
use App\Http\Controllers\Controller;

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
            if (Answer::where('contest_id', $contest->id)->where('user_id', Auth::user()->id)->exists()
            || LawResult::where('contest_id', $contest->id)->where('user_id', Auth::user()->id)->whereNotNull('time_end')->exists()) {
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

        return view('user.law.test', compact('contest', 'data', 'seconds'));
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

                $model->save();
            }
            $now = Carbon::now();
            LawResult::where('contest_id', $contestId)->where('user_id', Auth::user()->id)->update(['time_end' => $now]);
        } catch (\Exception $ex) {
            Toastr::error('Có lỗi '. $ex->getMessage());
            return redirect()->back();
        }

        Toastr::success('Bạn đã nộp bài thi! Vui lòng đợi kết quả công bố sau.');

        return redirect()->route('law.result', $contestId);
    }

    public function createQuestion($id, Request $request)
    {
        $data = LawQuestions::where('contest_id', $id)->get();

        return view('law.question.create', compact('data'));
    }

    public function question($id, Request $request)
    {
        $listQuestion = LawQuestions::where('contest_id', $id)->get();
        $contest = Contest::where('status', Contest::ENABLE)->findOrFail($id);

        return view('law.question.index', compact('contest', 'listQuestion'));
    }

    public function lawResult($id, Request $request)
    {
        $img = \Image::make(storage_path('app/public/law/image_cup.png'));
        $img->text(Auth::user()->full_name, 180, 80, function($font) {
            $font->file(public_path('fonts/tahoma.ttf'));
            $font->size(10);
            $font->color('#ff0000');
            $font->align('center');
            $font->valign('top');
        });
        $img->save(storage_path('app/public/law/'.Auth::user()->full_name.'.png'));
        
        return view('user.law.result');
    }
}
