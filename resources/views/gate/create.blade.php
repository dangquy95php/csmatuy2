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
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Cán bộ - Đối tác</button>
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
                                <form action="{{ route('gate.create.staff') }}#home-tab" method="post" accept-charset="UTF-8">
                                @csrf
                                    <div class="row mb-3">
                                      <label for="inputEmail3" class="col-sm-3 col-form-label">Tên nhân viên:<code>*</code></label>
                                      <div class="col-sm-9">
                                        <select id="staff" name="staff[]" class="form-control" placeholder="select one" multiple="multiple"></select>
                                        @include('_partials.alert', ['field' => 'staff'])
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
                                          <div class="form-check form-switch">
                                            <input class="form-check-input" name="drug_addict" {{old('drug_addict') ? 'checked' : ''}} type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Dẫn người cai nghiện</label>
                                          </div>
                                        </div>

                                        <div class="col-sm-5 number_drug_addict {{old('drug_addict') ? 'visible' : 'invisible'}}">
                                          <div class="row d-flex align-items-center">
                                            <label class="col-sm-4">Số lượng:</label>
                                            <div class="col-sm-6">
                                              <input type="number" value="{{old('number_of_drug_addicts')}}" min="0" name="number_of_drug_addicts" max="100" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                                            </div>
                                          </div>
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
                                      <textarea class="form-control area-note" name="note" placeholder="Vui lòng nhập ghi chú" id="floatingTextarea" style="height: 200px;"></textarea>
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
                                              <input class="form-check-input form-check-input_out" type="radio" name="type_gate" @if(old('type_gate') == '0') checked @endif id="gridRadios1" checked="" value="0">
                                              <label class="form-check-label" for="gridRadios1">
                                              Ra cổng
                                              </label>
                                          </div>
                                          <div class="form-check was-validated">
                                            <input class="form-check-input" type="radio" name="type_gate" @if(old('type_gate') == '1') checked @endif id="gridRadios2" value="1">
                                            <label class="form-check-label text-dark" for="gridRadios2">
                                            Vào cổng
                                            </label>
                                          </div>
                                        </div>
                                        <div class="col-sm-7">
                                          <!-- <button type="button" class="btn btn-info text-white btn-time"></button>
                                          <span class="time-now"></span> -->
                                          <div class="form-check form-switch time-switch">
                                            <input class="form-check-input" type="checkbox" name="time" {{old('time') ? 'checked' : ''}} id="flexSwitchCheckDefault1" value="{{old('time')}}">
                                            <label class="form-check-label" for="flexSwitchCheckDefault1">Thời gian hiện tại:<code>*</code></label>
                                            <strong>
                                              <span class="time-now text-danger">{{old('time')}}</span>
                                            </strong>
                                          </div>
                                          @include('_partials.alert', ['field' => 'time'])

                                          <input type="text" class="form-control" name="car_number" placeholder="Nhập bản số xe">
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
                                <form action="{{ route('gate.create.relatives_of_drug_addicts') }}#profile-tab" method="post" accept-charset="UTF-8">
                                @csrf 
                                    @if (count($errors->getBags()))
                                      <div class="alert alert-danger pb-0 show-alert">
                                          <ul>
                                              @foreach ($errors->getBags() as $bag)
                                                  @foreach ($bag->getMessages() as $messages)
                                                      @foreach ($messages as $message)
                                                          <li>{{ $message }}</li>
                                                      @endforeach
                                                  @endforeach
                                              @endforeach
                                          </ul>
                                      </div>
                                    @endif
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tên nhân thân: <span class="badge text-bg-primary add-employer" role="button"><i class="bi bi-plus-circle"></i></span></label>
                                        <div class="col-sm-9">
                                          @if(old('personal_name'))
                                            @for( $i =0; $i < count(old('personal_name')); $i++)                            
                                              <div class="add-employer-tab" role="button">
                                                <input type="text" value="{{ old('personal_name.'.$i)}}"  name="personal_name[]" class="form-control mt-1" />                                       
                                                <span class="badge bg-danger delete" onClick="employerFunction(this)"><i class="ri-delete-back-2-line"></i> Xóa</span>
                                              </div>

                                            @endfor
                                          @else
                                            <input type="text" name="personal_name[]" value="" class="form-control">
                                          @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPassword12" class="col-sm-3 col-form-label">Ghi chú:</label>
                                        <div class="col-sm-9 h-100">
                                          <!-- <div class="quill-editor-default1" style="height:200px;"></div> -->
                                          <textarea class="form-control" name="note1" placeholder="Vui lòng nhập ghi chú của bạn" id="floatingTextarea" style="height: 200px;">{{old('note') }}</textarea>
                                        </div>
                                    </div>
                                    <fieldset class="row mb-3">
                                      <legend class="col-form-label col-sm-3 pt-0">Loại hình:</legend>
                                      <div class="col-sm-2 in_and_out">
                                        <div class="form-check was-validated">
                                            <input class="form-check-input" type="radio" name="type_gate" id="gridRadios21" @if(old('type_gate') == '1') checked @endif value="1" checked="">
                                            <label class="form-check-label text-dark" for="gridRadios21">Vào cổng</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input_out"  type="radio" name="type_gate" @if(old('type_gate') == '0') checked @endif id="gridRadios11" value="0">
                                            <label class="form-check-label" for="gridRadios11">Ra cổng</label>
                                        </div>
                                      </div>
                                      <div class="col-sm-7">
                                        <!-- <button type="button" class="btn btn-info text-white btn-time"></button>
                                        <span class="time-now"></span> -->
                                        <div class="form-check form-switch time-switch">
                                          <input class="form-check-input" name="time1" {{old('time1') ? 'checked' : ''}} value="{{old('time1')}}" type="checkbox" id="flexSwitchCheckDefault11">
                                          <label class="form-check-label" for="flexSwitchCheckDefault11">Thời gian hiện tại:</label>
                                          <strong>
                                            <span class="time-now1 text-danger">{{old('time1')}}</span>
                                          </strong>
                                        </div>

                                        <!-- include('_partials.alert', ['field' => 'time']) -->
                                      </div>
                                    </fieldset>
                                    <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tên người cai nghiện: <span class="badge text-bg-primary name-add-employer" role="button"><i class="bi bi-plus-circle"></i></span></label>

                                        <div class="col-sm-9">
                                          @if(old('name_of_drug_addict'))
                                            @for( $i =0; $i < count(old('name_of_drug_addict')); $i++)                            
                                              <div class="add-employer-tab" role="button">
                                                <input type="text" value="{{ old('name_of_drug_addict.'.$i)}}"  name="name_of_drug_addict[]" class="form-control mt-1" />
                                                <span class="badge bg-danger delete" onClick="employerFunction(this)"><i class="ri-delete-back-2-line"></i> Xóa</span>
                                              </div>
                                            @endfor
                                          @else
                                            <input type="text" name="name_of_drug_addict[]" class="form-control">
                                          @endif

                                          <!-- include('_partials.alert', ['field' => 'name_of_drug_addict']) -->
                                        </div>

                                    </div>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-3 pt-0">Loại cai nghiện:</legend>
                                        <div class="col-sm-3">
                                          <div class="form-check">
                                              <input class="form-check-input form-check-input_out"  type="radio" name="kind_of_detox" id="gridRadios01" @if(old('kind_of_detox') == '1') checked @endif value="1" checked="">
                                              <label class="form-check-label" for="gridRadios01">Bắt buộc</label>
                                          </div>
                                          <div class="form-check was-validated">
                                              <input class="form-check-input" type="radio" name="kind_of_detox" id="gridRadios02" @if(old('kind_of_detox') == '0') checked @endif value="0">
                                              <label class="form-check-label text-dark" for="gridRadios02">Tự nguyện</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-6 d-flex flex-wrap align-items-center">
                                          <label for="inputPassword12" class="col-sm-3 col-form-label">Bản số xe:</label>
                                          <!-- <div class="col-sm-5 h-100"> -->
                                            <!-- <div class="quill-editor-default1" style="height:200px;"></div> -->
                                            <input type="text" name="car_number" class="form-control w-50" value="{{ old('car_number') }}">
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
                                <form action="{{ route('gate.create.guest_student') }}#contact-tab" method="post" accept-charset="UTF-8">
                                @csrf 
                                      <div class="row mb-3">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tên nhân viên:</label>
                                        <div class="col-sm-9">
                                          <input type="text" name="staff_name" value="{{old('staff_name')}}" class="form-control">
                                          @include('_partials.alert', ['field' => 'staff_name'])
                                        </div>
                                      </div>
                                      <div class="row mb-3 d-flex justify-content-between">
                                        <div class="col-sm-5">
                                          <div class="form-check form-switch">
                                            <input {{ old('drug_addict1') ? 'checked' : '' }} class="form-check-input" name="drug_addict1" type="checkbox" id="flexSwitchCheckCheckedNew">
                                            <label class="form-check-label" for="flexSwitchCheckCheckedNew">Dẫn người cai nghiện</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-5 number_drug_addict {{old('drug_addict1') ? 'visible' : 'invisible'}}">
                                          <div class="row d-flex align-items-center">
                                            <label class="col-sm-4">Số lượng:</label>
                                            <div class="col-sm-6">
                                              <input type="number" name="number_of_drug_addicts1" value="{{old('number_of_drug_addicts1')}}" min="0" max="100" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label for="inputPassword12" class="col-sm-3 col-form-label">Ghi chú:</label>
                                        <div class="col-sm-9 h-100">
                                          <!-- <div class="quill-editor-default1" style="height:200px;"></div> -->
                                          <textarea class="form-control" name="note2" placeholder="Vui lòng nhập ghi chú của bạn" id="floatingTextarea" style="height: 150px;">{{old('note2') }}</textarea>
                                        </div>
                                    </div>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-3 pt-0 type-gate">Loại hình:</legend>
                                        <div class="col-sm-2 in_and_out">
                                          <div class="form-check">
                                              <input class="form-check-input form-check-input_out" name="type_gate" @if(old('type_gate') == '1') checked @endif value="0" checked="" type="radio" id="gridRadios111">
                                              <label class="form-check-label" for="gridRadios111">
                                              Ra cổng
                                              </label>
                                          </div>
                                          <div class="form-check was-validated">
                                              <input class="form-check-input" type="radio" name="type_gate" @if(old('type_gate') == '1') checked @endif value="1" id="gridRadios22">
                                              <label class="form-check-label text-dark" for="gridRadios22">
                                              Vào cổng
                                              </label>
                                          </div>
                                        </div>
                                        <div class="col-sm-7 d-flex flex-wrap align-items-center">
                                          <label for="inputPassword12" class="col-sm-3 col-form-label">Bản số xe:</label>
                                          <!-- <div class="col-sm-5 h-100"> -->
                                            <!-- <div class="quill-editor-default1" style="height:200px;"></div> -->
                                            <input type="text" name="car_number" class="form-control w-50" value="{{ old('car_number') }}">
                                          <!-- </div> -->
                                          <div class="form-check form-switch time-switch">
                                            <input class="form-check-input" value="{{old('time2')}}" {{old('time2') ? 'checked' : ''}} name="time2" type="checkbox" id="flexSwitchCheckDefault0">
                                            <label class="form-check-label" for="flexSwitchCheckDefault0">Thời gian hiện tại:</label>
                                            <strong>
                                              <span class="time-now2 text-danger">{{old('time2')}}</span>
                                            </strong>
                                            @include('_partials.alert', ['field' => 'time2'])
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
    .image-team {
      width: 30px;
      height:30px;
    }
   
  </style>
@endpush

@push('scripts')
  <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
  <script>
    function employerFunction(data) {
      $(data).parent().remove();
    }
    $(document).ready(function() {
      var href = window.location.hash;
      if (href == '#home-tab') {
        if ($("#profile-tab").hasClass('active')) {
          $("#profile-tab").removeClass('active');
        }
        $("#home-tab").addClass('active');
        if($("#home").hasClass('fade')) {
          $("#home").removeClass('fade')
          $("#home").addClass('show')
        }
        $(".show-alert").addClass('d-none');
      }

      if (href == '#profile-tab') {
        if ($(".show-alert").hasClass('d-none')) {
          $(".show-alert").removeClass('d-none');
        }

        if ($("#home-tab").hasClass('active')) {
          $("#home-tab").removeClass('active');
        }
        $("#profile-tab").addClass('active');

        if($("#profile").hasClass('fade')) {
          $("#profile").removeClass('fade')
          $("#profile").addClass('show')
          $("#profile").addClass('active')
        }

        if($("#home").hasClass('show')) {
          $("#home").removeClass('show')
          $("#home").addClass('fade')
          $("#home").removeClass('active')
        }
      }

      if (href == '#contact-tab') {
        if (!$(".show-alert").hasClass('d-none')) {
          $(".show-alert").addClass('d-none');
        }

        if ($("#home-tab").hasClass('active')) {
          $("#home-tab").removeClass('active');
        }
        if ($("#profile-tab").hasClass('active')) {
          $("#profile-tab").removeClass('active');
        }
        $("#contact-tab").addClass('active');
        if($("#contact").hasClass('fade')) {
          $("#contact").removeClass('fade')
          $("#contact").addClass('show')
          $("#contact").addClass('active')
        }

        if($("#home").hasClass('show')) {
          $("#home").removeClass('show')
          $("#home").addClass('fade')
          $("#home").removeClass('active')
        }
        if($("#profile").hasClass('show')) {
          $("#profile").removeClass('show')
          $("#profile").addClass('fade')
          $("#profile").removeClass('active')
        }
      }

    $('.btn-note').click(function() {
      let tag = $(this).text().trim();
      var txt = $.trim($(this).text());
      var box = $(".area-note");
      box.val(box.val() + txt + ', ');
    });
    
    $(".add-employer").click(function() {
      $(this).parent().next().append(`<div class="add-employer-tab" role="button">
        <input type="text" name="personal_name[]" class="form-control mt-1">
        <span class="badge bg-danger delete" onClick="employerFunction(this)"><i class="ri-delete-back-2-line"></i> Xóa</span>
      </div>`);
    });

    $(".name-add-employer").click(function() {
      $(this).parent().next().append(`<div class="add-employer-tab" role="button">
        <input type="text" name="name_of_drug_addict[]" class="form-control mt-1">
        <span class="badge bg-danger delete" onClick="employerFunction(this)"><i class="ri-delete-back-2-line"></i> Xóa</span>
      </div>`);
    });
   
    // if ($("#home .time-switch input:checkbox").val()) {
    //   $("#home .time-switch input").trigger('click');
    // }
    // if ($("#contact .time-switch input:checkbox").val()) {
    //   $("#home .time-switch input").trigger('click');
    // }

    // $('.number_drug_addict [name="number_of_drug_addicts"]').each(function() {
    //   if ($($(this).closest('.card').find('[name="drug_addict"]').get(0)).val()) {
    //     if ($($(this).closest('.number_drug_addict').get(0)).hasClass('invisible')) {
    //       $($(this).closest('.number_drug_addict').get(0)).removeClass('invisible')
    //       $($(this).closest('.number_drug_addict').get(0)).addClass('visible')
    //     }
    //   }
    // })
    // if ($('#home .number_drug_addict [name="number_of_drug_addicts"]').val()) {
    //   $('#flexSwitchCheckDefault').trigger('click');
    //   if ($(".number_drug_addict").hasClass('invisible')) {
    //     $(".number_drug_addict").removeClass('invisible')
    //     $(".number_drug_addict").addClass('visible')
    //   }
    // }
    // if ($('#contact .number_drug_addict [name="number_of_drug_addicts"]').val()) {
    //   $('#flexSwitchCheckCheckedNew').trigger('click');
    //   if ($(".number_drug_addict").hasClass('invisible')) {
    //     $(".number_drug_addict").removeClass('invisible')
    //     $(".number_drug_addict").addClass('visible')
    //   }
    // }

    $("#home .time-switch input:checkbox").change(function() {
      if(this.checked) {
        let time = moment().format('YYYY-MM-DD hh:mm:ss');
        $(".time-now").text(time);
        $('#home .time-switch input').val(time);
      } else {
        $(".time-now").text('');
        $('#home .time-switch input').val('');
      }
    });

    $("#profile .time-switch input:checkbox").change(function() {
      if(this.checked) {
        let time = moment().format('YYYY-MM-DD hh:mm:ss');
        $(".time-now1").text(time);
        $('#profile .time-switch input').val(time);
      } else {
        $(".time-now1").text('');
        $('#profile .time-switch input').val('');
      }
    });

    $("#contact .time-switch input:checkbox").change(function() {
      if(this.checked) {
        let time = moment().format('YYYY-MM-DD hh:mm:ss');
        $(".time-now2").text(time);
        $('#contact .time-switch input').val(time);
      } else {
        $(".time-now2").text('');
        $('#contact .time-switch input').val('');
      }
    });

    $(".card [name='drug_addict']").change(function() {
      var ischecked= $(this).is(':checked');
      if(!ischecked) {
        $($(this).closest('.card').find(".number_drug_addict").get(0)).addClass('invisible');
        $($(this).closest('.card').find(".number_drug_addict").get(0)).removeClass('visible');
        // $("#home [name='number_of_drug_addicts']").val(null);
      } else {
        $($(this).closest('.card').find(".number_drug_addict").get(0)).removeClass('invisible');
        $($(this).closest('.card').find(".number_drug_addict").get(0)).addClass('visible');
      }
    });

    $(".card [name='drug_addict1']").change(function() {
      var ischecked= $(this).is(':checked');
      if(!ischecked) {
        $($(this).closest('.card').find(".number_drug_addict").get(0)).addClass('invisible');
        $($(this).closest('.card').find(".number_drug_addict").get(0)).removeClass('visible');
        // $("#home [name='number_of_drug_addicts']").val(null);
      } else {
        $($(this).closest('.card').find(".number_drug_addict").get(0)).removeClass('invisible');
        $($(this).closest('.card').find(".number_drug_addict").get(0)).addClass('visible');
      }
    });

    $(".in_and_out input:radio").change(function() {
      var data = $(this).val();
      if (data == 1) {
        $(this).closest('.card').removeClass('border border-danger border-3');
        $(this).closest('.card').addClass('border border-success border-3');
      } else {
        $(this).closest('.card').removeClass('border border-success border-3');
        $(this).closest('.card').addClass('border border-danger border-3');
      }
    });

    $('.create-note [type="reset"]').on('click',function(){
      $(".select2-selection__rendered").empty();
      $(".number_drug_addict").addClass('invisible');
      $(".time-now").empty();
    });

    function renderAccountInformation(data, container) {
      if (data.id === '') {
        return 'Select account';
      }
      const el = data.element;
      const accNickname = $(el).attr('data-account-nickname');
      const accNumber = $(el).attr('data-account-number');
      return $(`<strong>${accNickname}</strong><span>${accNumber}</span>`);
    }

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

    $('#staff').on('select2:select', function (e) {
      console.log(e);
    });

    $("#staff").select2({
      placeholder: "Chọn cán bộ của cơ sở ma túy số 2",
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