<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Models\Email;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

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
        $datas = Email::whereNotIn('auth_id', [Auth::user()->id])->orderBy('created_at')->with(['team', 'user', 'auth'])->get(); 
        $datas = $datas->groupBy('title');

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
            'content' => 'required|min:10',
        ], [
            'auth.required' => 'Vui lòng chọn người nhận',
            'title.required' => 'Tiêu đề mail của bạn chưa được nhập',
            'title.min' => 'Tiêu đề mail của bạn quá ngắn',
            'title.max' => 'Tiêu đề mail của bạn quá dài',
            'content.required' => 'Nội dung của bạn chưa được nhập',
            'content.min' => 'Nội dung của bạn nhập quá ngắn. Vui lòng nhập thêm',
        ]);

        $datas = $request->input('auth');
        $content = $request->get('content');
        $title = $request->input('title');

        \DB::beginTransaction();
        try {
            foreach($datas as $item) {
                $userByTeamId = User::where('team_id', $item)->select('id')->get();
                foreach($userByTeamId as $el) {
                    $mail = new Email;
                    $mail->title = $title;
                    $mail->content = $content;
                    $mail->team_id = $item;
                    $mail->user_id = $el->id;
                    $mail->auth_id = Auth::user()->id;
                    $mail->save();
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
        $datas = Email::where('auth_id', Auth::user()->id)->orderBy('created_at')->with(['team', 'user', 'auth'])->get();
        $datas = $datas->groupBy('title');

        return view('user.email.sent', compact('datas'));
    }
}