<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserInfor extends Model
{
    use HasFactory;

    protected $table = 'user_infors';

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ngay_sinh',
        'gioi_tinh',
        // 'noi_sinh_xa',
        // 'noi_sinh_huyen',
        // 'noi_sinh_tinh',
        // 'que_quan_xa',
        // 'que_quan_huyen',
        // 'que_quan_tinh',
        // 'kinh',
        // 'ton_giao',
        // 'thanh_phan_xuat_than',
        // 'vi_tri_viec_lam',
        // 'thu_viec',
        // 'ngay_vao_lam_viec_ngay_gia_nhap_tnxp',
        // 'ngach_luong',
        // 'ma_so_ngach',
        // 'bac_luong',
        // 'he_so_luong',
        // 'chenh_lech_bao_luu',
        // 'pctnvk',
        // 'moc_nang_bac_luong',
        // 'hoc_van',
        // 'bac_dao_tao',
        // 'hinh_thuc_dao_tao',
        // 'nganh_dao_tao',
        // 'ngoai_ngu',
        // 'tin_hoc',
        // 'qlnn',
        // 'chinh_tri',
        // 'bd_ldql_cap_phong',
        // 'anqp',
        // 'dang_vien',
        // 'du_bi',
        // 'chinh_thuc',
        // 'doan_tn',
        // 'cd_vien',
        // 'hdlv_vc',
        // '1_nam',
        // '1_3_nam',
        // 'khong_thoi_han',
        // 'hach_toan_don_vi',
        // 'ly_lich',
        // 'bang_cap_3',
        // 'cmnv',
        // 'dia_chi_ho_khau_thuong_tru',
        // 'noi_o_hien_nay',
        // 'so_cmnd_cccd',
        // 'ngay_cap',
        // 'noi_cap',
        // 'so_so_bhxh',
        // 'so_the_bhxh',
        // 'nghiep_vu_cong_tac_xa_hoi',
        // 'nghiep_vu_bao_ve',
        // 'nghiep_vu_su_pham',
        // 'tb_con_tb_gia_dinh_chinh_sach',
        // 'bo_doi_ca',
        // 'doi_vien_tnxp_xuat_ngu',
        // 'ghi_chu_hop_dong_loai',
        // 'ghi_chu',
    ];
}
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            