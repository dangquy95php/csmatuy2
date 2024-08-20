@section('title','Danh sách cán bộ vào ra cổng')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH CÁN BỘ VÀO RA CỔNG</h1>

   {{ Breadcrumbs::render('gate.index') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cổng ngày: <b class="time-now text-danger"></b></h5>
                    <table id="table1" class="table table-bordered border-primary table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle text-center w-25">Họ và tên</th>
                                <th rowspan="2" class="align-middle text-center" style="width: 180px;">Đơn vị</th>
                                <th class="align-middle text-center" colspan="2">Cán bộ</th>
                                <th class="align-middle text-center" colspan="2">Học viên</th>
                                <th rowspan="2" class="align-middle text-center">Ghi chú</th>
                                <th rowspan="2" class="align-middle text-center">Công việc</th>
                                <th rowspan="2" class="align-middle text-center" style="width:140px;">
                                    <button type="button" class="btn btn-success is-add">Thêm</button>
                                </th>
                            </tr>
                            <tr>
                                <th class="align-middle text-center" style="width: 100px;">Ra</th>
                                <th class="align-middle text-center" style="width: 100px;">Vào</th>
                                <th class="align-middle text-center" style="width: 100px;">Ra</th>
                                <th class="align-middle text-center" style="width: 100px;">Vào</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="root-tr">
                                <td style="max-width: 150px;">
                                    <div class="directorist-select directorist-select-multi" id="multiSelect" data-isSearch="true" data-max="20" data-multiSelect='[<?php echo $datas; ?>]' tabindex ="0">
                                        <input type="hidden">
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input justify-content-center" name="staff_out" type="checkbox">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input justify-content-center" name="staff_in" type="checkbox">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input justify-content-center" name="student_out" type="checkbox">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input justify-content-center" name="student_in" type="checkbox">
                                    </div>
                                </td>
                                <td>
                                    <textarea class="form-control" style="height:50px"></textarea>
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary">Xong</button>
                                    <button type="button" class="btn btn-warning">Sửa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>        
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
</section>

@endsection

@push('styles')
@endpush

@push('scripts')
<script src="{{ asset('js/script.js') }}"></script>

<script>

    $(".is-add").click(function() {
        let countTr = $('#table1 tbody tr').length;
        
        $('#table1 tbody tr:last').after(`
        <tr class="root-tr">
            <td style="max-width: 150px;">
                <div class="directorist-select directorist-select-multi" id="multiSelect${countTr}" data-isSearch="true" data-max="20"
                data-multiSelect="[<?php echo $datas; ?>]">
                    <input type="hidden">
                </div>
            </td>
            <td>
                <input type="text" class="form-control">
            </td>
            <td>
                <div class="form-check d-flex justify-content-center">
                    <input class="form-check-input justify-content-center" name="staff_out" type="checkbox">
                </div>
            </td>
            <td>
                <div class="form-check d-flex justify-content-center">
                    <input class="form-check-input justify-content-center" name="staff_in" type="checkbox">
                </div>
            </td>
            <td>
                <div class="form-check d-flex justify-content-center">
                    <input class="form-check-input justify-content-center" name="student_out" type="checkbox">
                </div>
            </td>
            <td>
                <div class="form-check d-flex justify-content-center">
                    <input class="form-check-input justify-content-center" name="student_in" type="checkbox">
                </div>
            </td>
            <td>
                <textarea class="form-control" style="height:50px"></textarea>
            </td>
            <td>
                <input type="text" class="form-control">
            </td>
            <td>
                <button type="button" class="btn btn-primary">Xong</button>
                <button type="button" class="btn btn-warning">Sửa</button>
            </td>
        </tr>`);

        function addFunction(el) {
            return pureScriptSelect(el);
        }

        addFunction(`#multiSelect${countTr}`);
    });

    pureScriptSelect('#multiSelect');

$(document).ready(function() {
   
   
   
});
  
</script>
@endpush
