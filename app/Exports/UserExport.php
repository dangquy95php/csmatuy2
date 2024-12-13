<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\User;

class UserExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    const EXCEL_TYPE_FILE = '.xlsx';

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas = User::with(['team', 'user_infor'])->where('status', User::ENABLE)->whereNotNull('team_id')->get();
        $result = [];
        foreach($datas as $k => $item) {
            $object = new \stdClass;

            $object->stt = ++$k;
            $object->name = $item->last_name .' '. $item->first_name;
            $object->email = $item->email;
            $object->department = $item->team->note;
            $object->gender = $item->user_infor->gioi_tinh == 1 ? 'Nữ' : 'Nam';

            array_push($result, $object);
        }

        return collect($result);
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
