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
        $contests = Answer::with(['user'])->where('answers.contest_id', $this->id)
                            ->join('law_questions', 'law_questions.question_id', '=', 'answers.id')
                            ->select('answers.*', 'answers.answer as answer_name', 'law_questions.*')
                            ->get();
dd($contests);
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
