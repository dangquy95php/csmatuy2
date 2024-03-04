<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInforsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user_infors');

        Schema::create('user_infors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('ngay_sinh')->nullable();
            $table->boolean('gioi_tinh')->default(0)->nullable();
            $table->string('noi_sinh_xa')->nullable();
            $table->string('noi_sinh_huyen')->nullable();
            $table->string('noi_sinh_tinh')->nullable();
            $table->string('que_quan_xa')->nullable();
            $table->string('que_quan_huyen')->nullable();
            $table->string('que_quan_tinh')->nullable();
            $table->string('dan_toc')->default('kinh');
            $table->boolean('ton_giao')->default(0)->nullable();
            $table->string('thanh_phan_xuat_than')->nullable();
            $table->string('vi_tri_viec_lam')->nullable();
            $table->datetime('thu_viec')->nullable();
            $table->datetime('ngay_vao_lam_viec_ngay_gia_nhap_tnxp')->nullable();
            $table->string('ngach_luong')->nullable();
            $table->string('ma_so_ngach')->nullable();
            $table->integer('bac_luong')->nullable();// bậc lương
            $table->double('he_so_luong', 15, 2)->nullable();
            $table->string('chenh_lech_bao_luu')->nullable();
            $table->string('pctnvk')->nullable();
            $table->datetime('moc_nang_bac_luong')->nullable();
            $table->string('hoc_van')->nullable();
            $table->string('bac_dao_tao')->nullable();
            $table->string('hinh_thuc_dao_tao')->nullable();
            $table->string('nganh_dao_tao')->nullable();
            $table->string('ngoai_ngu')->nullable();
            $table->string('tin_hoc')->nullable();
            $table->string('qlnn')->nullable();
            $table->string('chinh_tri')->nullable();
            $table->boolean('bd_ldql_cap_phong')->default(0)->nullable();
            $table->boolean('anqp')->default(0)->nullable();
            $table->boolean('dang_vien')->default(0)->nullable();
            $table->datetime('du_bi')->nullable();
            $table->datetime('chinh_thuc')->nullable();
            $table->boolean('doan_tn')->default(0)->nullable();
            $table->boolean('cd_vien')->default(0)->nullable();
            $table->boolean('hdlv_vc')->default(0)->nullable();
            $table->boolean('1_nam')->default(0)->nullable();
            $table->boolean('1_3_nam')->default(0)->nullable();
            $table->boolean('khong_thoi_han')->default(0)->nullable();
            $table->boolean('hach_toan_don_vi')->default(0)->nullable();
            $table->boolean('ly_lich')->default(0)->nullable();
            $table->boolean('bang_cap_3')->default(0)->nullable();
            $table->boolean('cmnv')->default(0)->nullable();
            $table->boolean('dia_chi_ho_khau_thuong_tru')->default(0)->nullable();
            $table->boolean('noi_o_hien_nay')->default(0)->nullable();
            $table->string('so_cmnd_cccd')->nullable();
            $table->datetime('ngay_cap')->nullable();
            $table->string('noi_cap')->nullable();
            $table->string('so_so_bhxh')->nullable();
            $table->string('so_the_bhxh')->nullable();
            $table->boolean('nghiep_vu_cong_tac_xa_hoi')->default(0)->nullable();
            $table->boolean('nghiep_vu_bao_ve')->default(0)->nullable();
            $table->boolean('nghiep_vu_su_pham')->default(0)->nullable();
            $table->string('tb_con_tb_gia_dinh_chinh_sach')->nullable();
            $table->boolean('bo_doi_ca')->default(0)->nullable();
            $table->boolean('doi_vien_tnxp_xuat_ngu')->default(0)->nullable();
            $table->string('ghi_chu_hop_dong_loai')->nullable();
            $table->string('ghi_chu')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('user_infors', function (Blueprint $table) {
        //     $table->dropForeign('user_id');
        // });

        Schema::dropIfExists('user_infors');
    }
}
