<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Models\Email;
use App\Models\EmailInfor;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use Illuminate\Support\Facades\Storage;

class EmailController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
       
    }

    /**
     * Display a listing of the resource.
         *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = EmailInfor::where('user_id', Auth::user()->id)->where('flag', EmailInfor::NEW)->with(['email'])->orderBy('created_at', 'DESC')->skip(0)->take(20)->get();

        return view('user.email.index', compact('datas'));
    }

    /**
     * Display a create of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {       
        $datas = Team::select('id', 'note as text')->get()->toArray();
        
        return view('user.email.create', compact('datas'));
    }

    /**
     * Display a create of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {     
        $this->validate($request, [
            'auth' => 'required',
            'title' => [
                'required',
                'min:10',
                'max:1000',
                function ($attribute, $value, $fail) {
                    if (Email::where([
                                'title' => $value,
                                'auth_id' => Auth::user()->id
                            ])->count() > 0) {
                        $fail('Tiêu đề bạn tạo đã trùng lần 2! Không được phép');
                    }
                },
            ],
            'file' => 'required|max:10000'
            // 'file.*' => 'mimetypes:jpeg,png,doc,docs,pdf,rar',
            // 'file' => 'required||mimes:jpeg,png,doc,docs,pdf,rar',
        // .rar, application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*
        ], [
            'auth.required' => 'Vui lòng chọn người nhận',
            'title.required' => 'Tiêu đề mail của bạn chưa được nhập',
            'title.min' => 'Tiêu đề mail của bạn quá ngắn',
            'title.max' => 'Tiêu đề mail của bạn quá dài',
            'file.required' => 'File chưa được chọn',
            // 'file.mimes' => 'Định dạng tập tin chưa đúng.',
            'file.max' => 'Dung lượng tập tin quá lớn'
        ]);

        \DB::beginTransaction();
        try {
            $files = $request->file('file');
            $dataFile = [];

            foreach($files as $file) {
                $unix_timestamp = now()->timestamp;
                $fileName = Auth::user()->id . '_' . $unix_timestamp;
                
                Storage::disk('local')->put('public/email/'. $fileName .'_'. $file->getClientOriginalName(), file_get_contents($file));
                array_push($dataFile, $fileName .'_'. $file->getClientOriginalName());
            }

            $email = Email::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'auth_id' => Auth::user()->id,
                'file'  => json_encode($dataFile)
            ]);

            $datas = $request->input('auth');
            foreach($datas as $team) {
                $userByTeamId = User::where('team_id', $team)->select('id')->get();
                foreach($userByTeamId as $el) {
                    if (Auth::user()->id !== $el->id) {
                        $mailInfor = new EmailInfor;
                        $mailInfor->team_id = $team;
                        $mailInfor->seen = EmailInfor::NOT_SEEN;
                        $mailInfor->user_id = $el->id;
                        $mailInfor->email_id = $email->id;
                        $mailInfor->updated_at = '';
                        
                        $mailInfor->save();
                    }
                }
            }
            \DB::commit();
        } catch (\Exception $ex) {
            \DB::rollback();
            Toastr::error('Gửi mail thất bại!'. $ex->getMessage());
            return redirect()->back();
        }
        Toastr::success('Gửi mail thành công!');

        return redirect()->route('email.sent');
    }

    /**
     * Display a create of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sent(Request $request)
    {
        $datas = Email::where('auth_id', Auth::user()->id)->with(['sub_email_infor'])->get();

        // $datas = Email::where('auth_id', Auth::user()->id)->orderBy('created_at')->with(['team', 'user', 'auth'])->get();
        // $datas = $datas->groupBy('title');

        return view('user.email.sent', compact('datas'));
    }

    public function updateSeen(Request $request)
    {
        $seen = $request->input('seen');
        $mailId = $request->input('email_id');

        try {
            $mail = EmailInfor::where('email_id', $mailId)->where('user_id', Auth::user()->id)->first();
            $mail->seen = EmailInfor::SEEN;
            $mail->time_seen = \Carbon\Carbon::now()->toDateTimeString();
            $mail->save();
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 500) ;
        }

        return response()->json('Cập nhật thành công',200) ;
    }

    public function delete(Request $request, $id)
    {
        try {
            $mail = EmailInfor::where('id', $id)->where('user_id', Auth::user()->id)->first();
            $mail->flag = EmailInfor::TRASH;
            $mail->save();
        } catch (\Exception $ex) {
            Toastr::error('Xóa mail thất bại!'. $ex->getMessage());
        }
        Toastr::success('Xóa mail thành công!');
        
        return redirect()->route('email.index');
    }

    public function trash(Request $request)
    {
        $datas = EmailInfor::where('user_id', Auth::user()->id)->where('flag', EmailInfor::TRASH)->with(['email'])->orderBy('created_at', 'DESC')->skip(0)->take(20)->get();

        return view('user.email.trash', compact('datas'));
    }
}