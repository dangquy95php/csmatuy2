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
                    <table class="table table-bordered border-primary table-hover">
                        <thead>
                            <tr>
                                <th style="width: 600px;" rowspan="2" class="align-middle text-center">Họ và tên</th>
                                <th rowspan="2" class="align-middle text-center">Đơn vị</th>
                                <th class="align-middle text-center" colspan="2">Cán bộ</th>
                                <th class="align-middle text-center" colspan="2">Học viên</th>
                                <th rowspan="2" class="align-middle text-center">Ghi chú</th>
                                <th rowspan="2" class="align-middle text-center">Công việc</th>
                                <th rowspan="2" class="align-middle text-center" style="width:130px;">Tác vụ</th>
                            </tr>
                            <tr>
                                <th class="align-middle text-center">Ra</th>
                                <th class="align-middle text-center">Vào</th>
                                <th class="align-middle text-center">Ra</th>
                                <th class="align-middle text-center">Vào</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="root-tr">
                                <td>
                                    <span role="button" class="badge bg-danger mb-1 btn-car-number">Nhập bản số xe:</span>
                                    <div class="staff-wrap">
                                        <select name="staff[]" class="form-control staff" placeholder="select one" multiple="multiple"></select>
                                    </div>
                                    <input type="text" name="car-number" class="input-car-number form-control d-none" placeholder="Nhập bản số xe">
                                    <!-- include('_partials.alert', ['field' => 'staff']) -->
                                </td>
                                <td class="align-bottom">
                                    <input type="text" name="team" class="form-control team d-none">
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-warning">Sửa</button>
                                    <button type="button" class="btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            <tr class="root-tr">
                                <td>
                                    <span role="button" class="badge bg-danger mb-1 btn-car-number">Nhập bản số xe:</span>
                                    <div class="staff-wrap">
                                        <select name="staff[]" class="form-control staff" placeholder="select one" multiple="multiple"></select>
                                    </div>
                                    <input type="text" name="car-number" class="input-car-number form-control d-none" placeholder="Nhập bản số xe">
                                    <!-- include('_partials.alert', ['field' => 'staff']) -->
                                </td>
                                <td class="align-bottom">
                                    <input type="text" name="team" class="form-control team d-none">
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-warning">Sửa</button>
                                    <button type="button" class="btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            <tr class="root-tr">
                                <td>
                                    <span role="button" class="badge bg-danger mb-1 btn-car-number">Nhập bản số xe:</span>
                                    <div class="staff-wrap">
                                        <select name="staff[]" class="form-control staff" placeholder="select one" multiple="multiple"></select>
                                    </div>
                                    <input type="text" name="car-number" class="input-car-number form-control d-none" placeholder="Nhập bản số xe">
                                    <!-- include('_partials.alert', ['field' => 'staff']) -->
                                </td>
                                <td class="align-bottom">
                                    <input type="text" name="team" class="form-control team d-none">
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-warning">Sửa</button>
                                    <button type="button" class="btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>        
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')

  <style>
    .select2-container--default .select2-results>.select2-results__options {
        max-height:400px;
    }

    .create-note .form-check-input_out:checked {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .customer-note .form-check-input_out:checked {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .add-employer-tab {
      position: relative;
    }
    .add-employer-tab span {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translate(-20%, -50%);
      z-index: 999;
    }
    .image-team {
      width: 30px;
      height:30px;
    }
  </style>
@endpush

@push('scripts')

<script>
    function formatState (state) {
      if (state.selected == false) {
        return state.text;
      }
      var baseUrl = "<?php echo asset('storage/profile/'); ?>"+"/"+ state.image;
      var $state = $(
        '<span><img src="'+ baseUrl +'" class="image-team" />&nbsp;&nbsp;' + state.text + '</span>'
      );
      return $state;
    };

    function template(data, container) {
      if(/Location\:/.test(data.text)) {
        return '<span class="location">'+ data.text +'</span>';
      } else {
        return data.text +' - '+ '<span class="badge rounded-pill bg-primary">'+ data.team_id +'</span>';
      }
    }

    $(document).ready(function() {

        $(".btn-car-number").click(function() {
            // $(this).closest('root-tr').find('.team')

            if (!$(this).hasClass('is-clicked')) {
                $($(this).closest('.root-tr').find(".input-car-number")[0]).removeClass('d-none');
                $($(this).closest('.root-tr').find(".input-car-number")[0]).addClass('d-block');
                $(this).addClass('is-clicked');
                $(this).next().addClass('d-none');

                $(this).text('Chọn nhân viên');
                $(this).addClass('bg-success');
                $(this).removeClass('bg-danger');

                
                $($(this).closest('.root-tr').find(".team")[0]).removeClass('d-none');
                $($(this).closest('.root-tr').find(".team")[0]).addClass('d-block');
            } else {
                $($(this).closest('.root-tr').find(".input-car-number")[0]).removeClass('d-block');
                $($(this).closest('.root-tr').find(".input-car-number")[0]).addClass('d-none');
                $(this).removeClass('is-clicked');
                $(this).next().removeClass('d-none');

                $(this).text('Nhập bản số xe');
                $(this).addClass('bg-danger');
                $(this).removeClass('bg-success');

                $($(this).closest('.root-tr').find(".team")[0]).addClass('d-none');
                $($(this).closest('.root-tr').find(".team")[0]).removeClass('d-block');
            }
        });

        
        $(".staff").select2({
            placeholder: "Chọn nhân viên",
            allowClear: true,
            width:'100%',
            maximumSelectionLength: 10,
            tags : true,
            // templateResult: renderAccountInformation,
            // templateSelection: renderAccountInformation,
            data: <?php echo json_encode($dataTeamAndEmployer); ?>,
            templateResult: formatState,
            tokenSeparators: [",", " "],
            templateSelection: template,
            escapeMarkup: function(m) { 
                return m; 
            },
        });
    });
</script>
@endpush
