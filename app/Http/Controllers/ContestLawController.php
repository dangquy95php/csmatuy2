<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Contest;
use App\Models\Answer;
use App\Models\LawQuestions;

class ContestLawController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:contestlaw-index|contestlaw-create|contestlaw-edit|contestlaw-delete', ['only' => ['index','store']]);
        $this->middleware('permission:contestlaw-create', ['only' => ['create','store']]);
        $this->middleware('permission:contestlaw-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:contestlaw-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function law($id, Request $request)
    {
        $contest = Contest::where('status', Contest::ENABLE)->findOrFail($id);
        if ($contest) {
            if (Answer::where('contest_id', $contest->id)->where('user_id', Auth::user()->id)->exists()) {
                abort(404);
            }
        }
        $data = LawQuestions::where('contest_id', $id)->get();


        return view('law.test', compact('contest', 'data'));
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
                $model->forecast = 100;
                $model->user_id = Auth::user()->id;
                $model->save();
                $id++;
            }
        } catch (\Exception $ex) {
            Toastr::error('Có lỗi '. $ex->getMessage());
            return redirect()->back();
        }
        
        Toastr::success('Bạn đã nộp bài thi! Vui lòng đợi kết quả công bố sau.');

        return redirect()->route('dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contest::with('user')->orderBy('created_at','DESC')->get();

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
}
