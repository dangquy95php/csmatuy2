<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\User;
use App\Models\Answer;
use App\Models\LawResult;
use Carbon\Carbon;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Exports\ContestExport;
use App\Exports\AnswerContestExport;
use Maatwebsite\Excel\Facades\Excel;


class ContestController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:contest-index|contest-create|contest-edit|contest-delete', ['only' => ['index','store']]);
        $this->middleware('permission:contest-create', ['only' => ['create','store']]);
        $this->middleware('permission:contest-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:contest-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contest::with('user')->orderBy('created_at','DESC')->get();

        return view('contests.index', compact('data'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $datas = User::with('team')->where('status', User::ENABLE)->where('level', User::TYPE_ACCOUNT_VC_NLD)->get();

        return view('contests.create', compact('datas'));
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
            'name' => 'required|unique:contests,name',
            'time_test' => 'required',
            'status' => 'required',
            'free_contest' => 'required',
        ]);
        
        $data = Contest::create([
            'name' => trim($request->input('name')),
            'description' => trim($request->input('description')),
            'user_id' => Auth::user()->id,
            'time_test' => trim($request->input('time_test')),
            'status' => $request->input('status'),
            'free_contest' => json_encode($request->input('free_contest')),
        ]);
       
        $data->link = $request->root() .'/contest/'. $data->id .'/law';
        $data->save();
    
        Toastr::success('Tạo cuộc thi thành công!');

        return redirect()->route('contest.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contest = Contest::findOrFail($id);
        $datas = User::with('team')->where('status', User::ENABLE)->where('level', User::TYPE_ACCOUNT_VC_NLD)->get();

        return view('contests.edit', compact('contest', 'datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export($id)
    {
        $time = date('Y-m-d H:i:s');
        $time = str_replace(':', '_', $time);
        $time = str_replace(' ', '_', $time);

        return Excel::download(new ContestExport($id), $time . 'danh-sach-thi-phap-luat.xlsx');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'time_test' => 'required',
            'status' => 'required',
            'free_contest' => 'required',
        ]);

        $contest = Contest::find($id);
        $contest->name = trim($request->input('name'));
        $contest->description = trim($request->input('description'));
        $contest->time_test = trim($request->input('time_test'));
        $contest->status = $request->input('status');
        $contest->user_id = Auth::user()->id;
       
        $checkDiff = array_diff(json_decode($contest->free_contest), $request->input('free_contest'));
        $checkDiff1 = array_diff($request->input('free_contest'), json_decode($contest->free_contest));

        if (count($checkDiff) > 0 || count($checkDiff1) > 0) {
            $contest->free_contest = $request->input('free_contest');
        }
        $contest->save();

        if ($contest->wasChanged()) {
            Toastr::success('Cập nhật cuộc thi thành công!');
        } else {
            Toastr::warning('Dữ liệu không có thay đổi');
        }
        return redirect()->back();
    }

    public function tested(Request $request, $id)
    {
        $contest = Contest::findOrFail($id);
        $contests = LawResult::where('contest_id', $id)->pluck('user_id')->toArray();
        
        // \DB::connection()->enableQueryLog();
        $usersExitsInLawResult = User::with('team')->whereNotIn('id', json_decode($contest->free_contest))
            ->where('status', User::ENABLE)->where('level', User::TYPE_ACCOUNT_VC_NLD)
            ->whereIn('id', $contests)->with(['answers' => function($query) use($id) {
                $query->join('law_questions', 'answers.question_id', '=', 'law_questions.question_id')->where('answers.contest_id', $id)
                ->where('answers.contest_id', $id)
                ->where('law_questions.contest_id', $id)
            ->orderByRaw('CONVERT(answers.question_id, SIGNED) ASC')
            ->select('answers.*', 'answers.answer as answer1', 'law_questions.question_id as id_question', 'law_questions.question_name as name_question',
            'law_questions.a', 'law_questions.b', 'law_questions.c', 'law_questions.d', 'law_questions.point', 'law_questions.answer');
        }])->get()->sortBy('answers.created_at');
        
        // $queries = \DB::getQueryLog();

        $lawResults = LawResult::where('contest_id', $id)->get();
        foreach($lawResults as &$item) {
            $startDate = Carbon::createFromFormat('d-m-Y H:i:s', Carbon::parse($item->time_start)->format('d-m-Y H:i:s'));
            $endDate = Carbon::createFromFormat('d-m-Y H:i:s', Carbon::parse($item->time_end)->format('d-m-Y H:i:s'));
            
            $days = $startDate->diffInDays($endDate);
            $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
            $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);
            $seconds = $startDate->copy()->addDays($days)->addHours($hours)->addMinutes($minutes)->diffInSeconds($endDate);

            $item->time = $hours . ' giờ '. $minutes . ' phút ' . $seconds . ' giây';
        }

        $listUserId = $contest->free_contest;
        $predict = User::join('answers', 'users.id', '=', 'answers.user_id')->where('users.status', User::ENABLE)
                        ->where('users.level', User::TYPE_ACCOUNT_VC_NLD)
                        ->whereNotIn('users.id', json_decode($listUserId))
                        ->where('answers.contest_id', $id)
                        ->where('answers.question_id', 'predict')->select('answers.*')->get();

        
        $usersYetTest = User::with('team')->where('status', User::ENABLE)
                            ->where('level', User::TYPE_ACCOUNT_VC_NLD)
                            ->whereNotIn('id', json_decode($listUserId))->whereNotIn('id', $contests)->get();
        $userFreeContest = User::whereIn('id', json_decode($listUserId))->get();


        return view('contests.tested', compact('contest', 'usersExitsInLawResult', 'usersYetTest', 'userFreeContest', 'predict', 'lawResults'));
    }
}