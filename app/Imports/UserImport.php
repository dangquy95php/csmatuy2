<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use App\Models\Team;
use App\Models\UserInfor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use DB;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UserImport implements ToModel, WithHeadingRow, WithStartRow, WithChunkReading, ShouldQueue
{
    /**
    * @param Collection $collection
    */
    public function chunkSize(): int
    {
        return 50;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function startRow(): int
    {
        return 3;
    }

    public function model(array $row)
    {
        \Log::info($row);
        try {
            if (!empty($row['stt'])) {
                $teamId = Team::where('note', $row[1])->select('id')->first();
    
                DB::beginTransaction();

                $explodeData = explode(" ", trim($row['ho_va_ten']));
                $firstName = $explodeData[count($explodeData) - 1];
                $lastName = str_replace($firstName, "", trim($row['ho_va_ten']));

                $input['first_name'] = $firstName;
                $input['last_name'] = trim($lastName);
                $input['password'] = 12345678;
                $input['team_id'] = $teamId->id;
                $input['level'] = User::TYPE_ACCOUNT_VC_NLD;
                $input['image'] = \Illuminate\Support\Str::upper($row['ho_va_ten']).'.jpg';
                if ($row['ho_va_ten'] == 'Cao Văn Tuấn') {
                    $input['username'] = 'CaoVanTuan1';
                } else {
                    $input['username'] = convert_vi_to_en_and_remove_space($row['ho_va_ten']);
                }
                
                $input['is_account_enabled'] = 1;
                $input['status'] = 1;
        
                $user = User::create($input);
        
                if (Str::contains($row['vi_tri_viec_lam'], 'Giám đốc')) {
                    $user->assignRole('admin');
                } elseif (($row['vi_tri_viec_lam'] == 'Trưởng phòng') || ($row['vi_tri_viec_lam'] == 'Trưởng khu')) {
                    $user->assignRole('manager');
                } elseif(($row['vi_tri_viec_lam'] == 'Phó trưởng phòng') || $row['vi_tri_viec_lam'] == 'Phó Trưởng khu') {
                    $user->assignRole('deputy');
                } else {
                    $user->assignRole('staff');
                }
                
                // $date = $row['nam'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(@$row['nam'])->format('d/m/Y') : \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(@$row['nu'])->format('d/m/Y');
                $data = new UserInfor([
                    'user_id'                                 => $user->id,
                    'ngay_sinh'                               => $row['nam'] ? $row['nam'] : $row['nu'],
                    'gioi_tinh'                               => $row['nam'] ? 1 : 0,
                    'noi_sinh_xa'                             => $row['noi_sinh'],
                    'noi_sinh_huyen'                          => $row[7],
                    'noi_sinh_tinh'                           => $row[8],
                    'que_quan_xa'                             => $row['que_quan'],
                    'que_quan_huyen'                          => $row[10],
                    'que_quan_tinh'                           => $row[11],
                    'dan_toc'                                 => $row['dan_toc'],
                    'ton_giao'                                => $row['ton_giao'],
                    'thanh_phan_xuat_than'                    => $row['thanh_phan_xuat_than'],
                    'vi_tri_viec_lam'                         => $row['vi_tri_viec_lam'],
                    'thu_viec'                                => $row['thu_viec'],
                    'ngay_vao_lam_viec_ngay_gia_nhap_tnxp'    => $row['ngay_vao_lam_viec_ngay_gia_nhap_tnxp'],
                    'ngach_luong'                             => $row['ngach_luong'],
                    'ma_so_ngach'                             => $row['ma_so_ngach'],
                    'bac_luong'                               => $row['bac_luong'],
                    'he_so_luong'                             => $row['he_so_luong'],
                    'chenh_lech_bao_luu'                      => $row['chenh_lech_bao_luu'],
                    'pctnvk'                                  => $row['pctnvk'],
                    'moc_nang_bac_luong'                      => $row['moc_nang_bac_luong'],
                    'hoc_van'                                 => $row['hoc_van'],
                    'bac_dao_tao'                             => $row['bac_dao_tao'],
                    'hinh_thuc_dao_tao'                       => $row['hinh_thuc_dao_tao'],
                    'nganh_dao_tao'                           => $row['nganh_dao_tao'],
                    'ngoai_ngu'                               => $row['ngoai_ngu'],
                    'tin_hoc'                                 => $row['tin_hoc'],
                    'qlnn'                                    => $row['qlnn'],
                    'chinh_tri'                               => $row['chinh_tri'],
                    'bd_ldql_cap_phong'                       => $row['bd_ldql_cap_phong'],
                    'anqp'                                    => $row['anqp'],
                    'dang_vien'                               => $row['dang_vien'],
                    'du_bi'                                   => $row['du_bi'],
                    'chinh_thuc'                              => $row['chinh_thuc'],
                    'doan_tn'                                 => $row['doan_tn'],
                    'cd_vien'                                 => $row['cd_vien'],
                    'hdlv_vc'                                 => $row['hdlv_vc'],
                    '1_nam'                                   => $row['1_nam'],
                    '1_3_nam'                                 => $row['1_3_nam'],
                    'khong_thoi_han'                          => $row['khong_thoi_han'],
                    'hach_toan_don_vi'                        => $row['hach_toan_don_vi'],
                    'ly_lich'                                 => $row['ly_lich'],
                    'bang_cap_3'                              => $row['bang_cap_3'],
                    'cmnv'                                    => $row['cmnv'],
                    'dia_chi_ho_khau_thuong_tru'              => $row['dia_chi_ho_khau_thuong_tru'],
                    'noi_o_hien_nay'                          => $row['noi_o_hien_nay'],
                    'so_cmnd_cccd'                            => $row['so_cmnd_cccd'],
                    'ngay_cap'                                => $row['ngay_cap'],
                    'noi_cap'                                 => $row['noi_cap'],
                    'so_so_bhxh'                              => $row['so_so_bhxh'],
                    'so_the_bhxh'                             => $row['so_the_bhxh'],
                    'nghiep_vu_cong_tac_xa_hoi'               => $row['nghiep_vu_cong_tac_xa_hoi'],
                    'nghiep_vu_bao_ve'                        => $row['nghiep_vu_bao_ve'],
                    'nghiep_vu_su_pham'                       => $row['nghiep_vu_su_pham'],
                    'tb_con_tb_gia_dinh_chinh_sach'           => $row['tb_con_tb_gia_dinh_chinh_sach'],
                    'bo_doi_ca'                               => $row['bo_doi_ca'],
                    'doi_vien_tnxp_xuat_ngu'                  => $row['doi_vien_tnxp_xuat_ngu'],
                    'ghi_chu_hop_dong_loai'                   => $row['ghi_chu_hop_dong_loai'],
                    'ghi_chu'                                 => $row['ghi_chu'],
                ]);
                DB::commit();
                return $data;
            }  
        } catch (\Exception $ex) {
            \Log::info($ex->getMessage());
            DB::rollBack();
            throw new \Exception($ex->getMessage());
        }
    }

    public function rules(): array
    {
        return [
            'ho_va_ten' => ['required'],//số hợp đồng
        ];
    }
}
