<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\User;
use App\Models\Contest;
use App\Models\Answer;

class ContestExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    const EXCEL_TYPE_FILE = '.xlsx';

    protected $id;

    public function __construct($id) {
        $this->id = $id;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $contests = User::where('status', User::ENABLE)->where('level', User::TYPE_ACCOUNT_VC_NLD)
                        ->with(['answers' => function($query) {
                            $query->join('law_questions', 'answers.question_id', '=', 'law_questions.question_id')->where('answers.contest_id', $this->id)
                                ->select('answers.*', 'law_questions.a', 'law_questions.b', 'law_questions.c', 'law_questions.d', 'law_questions.point', 'law_questions.answer as answer1');
                        }])

        //  Answer::with(['user'])->where('answers.contest_id', $this->id)
        //                     ->join('law_questions', 'law_questions.question_id', '=', 'answers.question_id')
                            
                            ->get()->toArray();
dd($contests[11]);
        foreach($contests as $key => $item) {
            if ($item['answer'] == base64_decode($item[$key])) {

            }
        }

        $datas = User::with(['team', 'user_infor'])->where('status', User::ENABLE)->whereNotNull('team_id')->get();
        $result = [];
       
        // return collect($result);
    }

    public function headings() :array {
    	return ["STT", "Tên nhân viên", "Email", "Bộ phận", "Ngày sinh", "Giới Tính"];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:J1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            },
        ];
    }
}
