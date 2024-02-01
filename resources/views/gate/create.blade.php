@section('title','Tạo phiếu ra vào cổng')
@extends('layouts.template')

@section('breadcrumb')

   <h1>TẠO PHIẾU RA VÀO CỔNG</h1>

   {{ Breadcrumbs::render('gate.create') }}

@endsection

@section('content')

<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- <h5 class="card-title">Default Tabs</h5> -->

              <!-- Default Tabs -->
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Cán bộ</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Người thân của người cai nghiện đưa lên</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Khách đưa quân lên</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-lg-6">
                        <div class="card create-note border border-danger border-3">
                            <div class="card-body pt-3">
                                <!-- <h5 class="card-title">Horizontal Form</h5> -->

                                <!-- Horizontal Form -->
                                <form>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tên nhân viên:</label>
                                        <div class="col-sm-9">
                                          <select id="staff" class="form-control" placeholder="select one" multiple="multiple"></select>
                                        </div>
                                    </div>
                                    <!-- <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Giờ:</label>
                                        <div class="col-sm-9">
                                        <span class="badge rounded-pill bg-success time-now" role="button">Lấy giờ hiện tại</span>
                                        <span class="time-number"></span>
                                        <input type="text" class="form-control" id="inputEmail">
                                        </div>
                                    </div> -->
                                    <div class="row mb-3 d-flex justify-content-between">
                                        <div class="col-sm-5">
                                          <div class="form-check form-switch check_drug_addict">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Dẫn người cai nghiện</label>
                                          </div>
                                        </div>

                                        <div class="col-sm-5 invisible number_drug_addict">
                                          <div class="row d-flex align-items-center">
                                            <label class="col-sm-4">Số lượng:</label>
                                            <div class="col-sm-6">
                                              <input type="number" value="1" min="1" max="100" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                      <label for="inputPassword3" class="col-sm-3 col-form-label">Đơn vị:</label>
                                      <div class="col-sm-9 h-100">
                                        <select class="form-select" aria-label="Default select example">
                                          <option selected="">Vui lòng chọn đơn vị</option>
                                          @foreach ($teams as $key => $data)
                                            <option value="1">{{ $data->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row mb-3">
                                      <label for="inputPassword3" class="col-sm-3 col-form-label">Ghi chú:
                                        @foreach ($gateNote as $key => $data)
                                          <span role="button" class="badge bg-secondary btn-note">
                                              {{ $data->name }} <i class="ri-check-line"></i>
                                          </span>
                                        @endforeach
                                      </label>
                                      <div class="col-sm-9 h-100">
                                      <textarea class="form-control area-note" placeholder="Vui lòng nhập ghi chú" id="floatingTextarea" style="height: 200px;"></textarea>
                                          <!-- <div class="form-floating">
                                              <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 200px;"></textarea>
                                              <label for="floatingTextarea">Mô tả hoạt động ra vào cổng</label>
                                          </div> -->
                                      </div>
                                    </div>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-3 pt-0 type-gate">Loại hình:</legend>
                                        <div class="col-sm-2 in_and_out">
                                          <div class="form-check">
                                              <input class="form-check-input form-check-input_out"  type="radio" name="gate_in_out" id="gridRadios1" value="out" checked="">
                                              <label class="form-check-label" for="gridRadios1">
                                              Ra cổng
                                              </label>
                                          </div>
                                          <div class="form-check was-validated">
                                            <input class="form-check-input" type="radio" name="gate_in_out" id="gridRadios2" value="in">
                                            <label class="form-check-label text-dark" for="gridRadios2">
                                            Vào cổng
                                            </label>
                                          </div>
                                        </div>
                                        <div class="col-sm-7">
                                          <!-- <button type="button" class="btn btn-info text-white btn-time"></button>
                                          <span class="time-now"></span> -->
                                          <div class="form-check form-switch time-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault1">
                                            <label class="form-check-label" for="flexSwitchCheckDefault1">Thời gian hiện tại:</label>
                                            <strong>
                                              <span class="time-now text-danger"></span>
                                            </strong>
                                          </div>
                                        </div>
                                    </fieldset>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Tạo phiếu</button>
                                        <button type="reset" class="btn btn-secondary">Làm sạch dữ liệu</button>
                                    </div>
                                </form><!-- End Horizontal Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="col-lg-6">
                        <div class="card customer-note border border-success border-3">
                            <div class="card-body pt-3">
                                <!-- <h5 class="card-title">Horizontal Form</h5> -->

                                <!-- Horizontal Form -->
                                <form>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tên nhân thân: <span class="badge text-bg-primary add-employer" role="button"><i class="bi bi-plus-circle"></i></span></label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword12" class="col-sm-3 col-form-label">Ghi chú:</label>
                                        <div class="col-sm-9 h-100">
                                          <!-- <div class="quill-editor-default1" style="height:200px;"></div> -->
                                          <textarea class="form-control" placeholder="Vui lòng nhập ghi chú của bạn" id="floatingTextarea" style="height: 200px;"></textarea>
                                        </div>
                                    </div>
                                    <fieldset class="row mb-3">
                                      <legend class="col-form-label col-sm-3 pt-0">Loại hình:</legend>
                                      <div class="col-sm-2 customer_in_and_out">
                                        <div class="form-check was-validated">
                                            <input class="form-check-input" type="radio" name="gate_customer_in_out" id="gridRadios21" value="in" checked="">
                                            <label class="form-check-label text-dark" for="gridRadios21">Vào cổng</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input_out"  type="radio" name="gate_customer_in_out" id="gridRadios11" value="out">
                                            <label class="form-check-label" for="gridRadios11">Ra cổng</label>
                                        </div>
                                      </div>
                                      <div class="col-sm-7">
                                        <!-- <button type="button" class="btn btn-info text-white btn-time"></button>
                                        <span class="time-now"></span> -->
                                        <div class="form-check form-switch time-switch">
                                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault11">
                                          <label class="form-check-label" for="flexSwitchCheckDefault11">Thời gian hiện tại:</label>
                                          <strong>
                                            <span class="time-now1 text-danger"></span>
                                          </strong>
                                        </div>
                                      </div>
                                    </fieldset>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tên người cai nghiện: <span class="badge text-bg-primary add-employer" role="button"><i class="bi bi-plus-circle"></i></span></label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-3 pt-0">Loại cai nghiện:</legend>
                                        <div class="col-sm-3 in_and_out">
                                          <div class="form-check">
                                              <input class="form-check-input form-check-input_out"  type="radio" name="kind_of_detox" id="gridRadios01" value="out" checked="">
                                              <label class="form-check-label" for="gridRadios01">Bắt buộc</label>
                                          </div>
                                          <div class="form-check was-validated">
                                              <input class="form-check-input" type="radio" name="kind_of_detox" id="gridRadios02" value="in">
                                              <label class="form-check-label text-dark" for="gridRadios02">Tự nguyện</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6 d-flex flex-wrap align-items-center">
                                          <label for="inputPassword12" class="col-sm-3 col-form-label">Bản số xe:</label>
                                          <!-- <div class="col-sm-5 h-100"> -->
                                            <!-- <div class="quill-editor-default1" style="height:200px;"></div> -->
                                            <input type="text" name="license_plate" class="form-control w-50">
                                          <!-- </div> -->
                                        </div>

                                    </fieldset>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Tạo phiếu</button>
                                        <button type="reset" class="btn btn-secondary">Làm sạch dữ liệu</button>
                                    </div>
                                </form><!-- End Horizontal Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="col-lg-6">
                        <div class="card create-note border border-danger border-3">
                            <div class="card-body pt-3">
                                <form>
                                      <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tên nhân viên:</label>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control">
                                        </div>
                                      </div>
                                      <div class="row mb-3 d-flex justify-content-between">
                                        <div class="col-sm-5">
                                          <div class="form-check form-switch check_drug_addict">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Dẫn người cai nghiện</label>
                                          </div>
                                        </div>

                                        <div class="col-sm-5 invisible number_drug_addict">
                                          <div class="row d-flex align-items-center">
                                            <label class="col-sm-4">Số lượng:</label>
                                            <div class="col-sm-6">
                                              <input type="number" value="1" min="1" max="100" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-3 pt-0 type-gate">Loại hình:</legend>
                                        <div class="col-sm-9 in_and_out">
                                          <div class="form-check">
                                              <input class="form-check-input form-check-input_out"  type="radio" name="gate_in_out" id="gridRadios1" value="out" checked="">
                                              <label class="form-check-label" for="gridRadios1">
                                              Ra cổng
                                              </label>
                                          </div>
                                          <div class="form-check was-validated">
                                              <input class="form-check-input" type="radio" name="gate_in_out" id="gridRadios2" value="in">
                                              <label class="form-check-label text-dark" for="gridRadios2">
                                              Vào cổng
                                              </label>
                                          </div>
                                        </div>
                                    </fieldset>
                                   
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Tạo phiếu</button>
                                        <button type="reset" class="btn btn-secondary">Làm sạch dữ liệu</button>
                                    </div>
                                </form><!-- End Horizontal Form -->
                            </div>
                        </div>
                    </div>
                </div>
              </div><!-- End Default Tabs -->
            </div>
          </div>
      </div>
    </section>
@endsection

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
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
  </style>
@endpush

@push('scripts')
  <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
  <script>
    $('.btn-note').click(function() {
      let tag = $(this).text().trim();
      $(".area-note").append(tag + ', ');
    });

    $(".add-employer").click(function() {
      $(this).parent().next().append(`<div class="add-employer-tab" role="button">
        <input type="text" class="form-control mt-1">
        <span class="badge bg-danger delete" onClick="employerFunction(this)"><i class="ri-delete-back-2-line"></i> Xóa</span>
      </div>`);
    });

    function employerFunction(data) {
      $(data).parent().remove();
    }
    
    $("#home .time-switch input:checkbox").change(function() {
      if(this.checked) {
        let time = moment().format('YYYY-MM-DD hh:mm:ss');
        $(".time-now").text(time);
      } else {
        $(".time-now").text('');
      }
    });

    $("#profile .time-switch input:checkbox").change(function() {
      if(this.checked) {
        let time = moment().format('YYYY-MM-DD hh:mm:ss');
        $(".time-now1").text(time);
      } else {
        $(".time-now1").text('');
      }
    });

    $(".check_drug_addict input:checkbox").change(function() {
      var ischecked= $(this).is(':checked');
      if(!ischecked) {
        $(".number_drug_addict").addClass('invisible');
        $(".number_drug_addict").removeClass('visible');
      } else {
        $(".number_drug_addict").removeClass('invisible');
        $(".number_drug_addict").addClass('visible');
      }
    });

    $(".customer_in_and_out input:radio").change(function() {
      var data = $("input[name='gate_customer_in_out']:checked").val();
      if (data == 'in') {
        $(".customer-note").removeClass('border border-danger border-3');
        $(".customer-note").addClass('border border-success border-3');
      } else {
        $(".customer-note").removeClass('border border-success border-3');
        $(".customer-note").addClass('border border-danger border-3');
      }
    });

    $(".in_and_out input:radio").change(function() {
      var data = $("input[name='gate_in_out']:checked").val();
      if (data == 'in') {
        $(".create-note").removeClass('border border-danger border-3');
        $(".create-note").addClass('border border-success border-3');
      } else {
        $(".create-note").removeClass('border border-success border-3');
        $(".create-note").addClass('border border-danger border-3');
      }
    });

    $('.create-note [type="reset"]').on('click',function(){
      $(".select2-selection__rendered").empty();
      $(".number_drug_addict").addClass('invisible');
      $(".time-now").empty();
    });

     $("#staff").select2({
        placeholder: "Chọn cán bộ của cơ sở ma túy số 2",
        allowClear: true,
        width:'100%',
        maximumSelectionLength: 10,
        tags : true,
        data: <?php echo json_encode($dataTeamAndEmployer); ?>
      });
  </script>
@endpush