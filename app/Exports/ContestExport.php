<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use App\Models\Contest;
use App\Models\Answer;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ContestExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithStrictNullComparison, WithColumnFormatting
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
        $listUserId = Contest::findOrFail($this->id);
        $contests = User::whereNotIn('id', json_decode($listUserId->free_contest))->where('status', User::ENABLE)->where('level', User::TYPE_ACCOUNT_VC_NLD)->with('team')
                        ->with(['answers' => function($query) {
                        $query->join('law_questions', 'answers.question_id', '=', 'law_questions.question_id')
                        ->where('answers.contest_id', $this->id)
                        ->where('law_questions.contest_id', $this->id)
                    ->select('answers.*', 'law_questions.point');
                }])->get();

        $result = [];

        foreach($contests as $k => $items) {
            $object = new \stdClass;

            $object->stt = ++$k;
            $object->name = $items['last_name'] .' '. $items['first_name'];
            $object->department = $items['team']['note'];
            $count = 0;
            if (count($items['answers']) > 0) {
                foreach($items['answers'] as $item) {
                    if ($item['result'] == Answer::CORRECT) {
                        $count++;
                    }
                }
            }

            $object->result = (string)$count .'/'. count($items['answers']);

            array_push($result, $object);
        }

        return collect($result);
    }

    public function headings() :array {
    	return ["STT", "Tên nhân viên", "Bộ phận", "Điểm", 'Số dự đoán'];
    }
    
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                // $event->sheet->setCellValue('A1', 'Time String')
                // ->setCellValue('A2', '31-Dec-2008 17:30:20')
                // ->setCellValue('A3', '14-Feb-2008 4:20 AM')
                // ->setCellValue('A4', '14-Feb-2008 4:45:59 PM');

                $cellRange = 'A1:T500'; // All headers
                // $event->sheet->getDelegate()->getParent()->getDefaultStyle()->getFont()->setName('Times New Roman');
                // $sheet->setFontFamily('Comic Sans MS');
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Times New Roman');
                $event->sheet->getDelegate()->getStyle($cellRange)->getFill();
                $event->sheet->getStyle('D')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('D')->getAlignment()->setHorizontal('center');
            },
        ];
    }
}
