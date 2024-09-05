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
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{route('gate.show')}}" class="card-title">Cổng ngày: <b class="time-now text-danger">{{ date('d-m-Y') }}</b></a>    
                        <div class="search-bar">
                            <form class="search-form d-flex align-items-center" method="POST" action="">
                                <input type="text" name="end" placeholder="Tìm kiếm" title="Tìm kiếm">
                                <button type="submit" title="Tìm kiếm"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <table id="table1" class="table table-bordered border-danger table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle text-center w-25 bg-primary text-white border border-white">Họ và tên</th>
                                <th rowspan="2" class="align-middle text-center bg-primary text-white border border-white" style="width: 180px;">Đơn vị</th>
                                <th class="align-middle text-center bg-primary text-white border border-white" colspan="2">Cán bộ</th>
                                <th class="align-middle text-center bg-primary text-white border border-white" colspan="2">Học viên</th>
                                <th rowspan="2" class="align-middle text-center bg-primary text-white border border-white">Ghi chú</th>
                                <th rowspan="2" class="align-middle text-center bg-primary text-white border border-white">Công việc</th>
                                <th rowspan="2" class="align-middle text-center bg-primary text-white border border-white" style="width:140px;">
                                    <button type="button" class="btn btn-success is-add border border-white">Thêm</button>
                                </th>
                            </tr>
                            <tr>
                                <th class="align-middle text-center bg-primary text-white border border-white" style="width: 100px;">Ra</th>
                                <th class="align-middle text-center bg-primary text-white border border-white" style="width: 100px;">Vào</th>
                                <th class="align-middle text-center bg-primary text-white border border-white" style="width: 100px;">Ra</th>
                                <th class="align-middle text-center bg-primary text-white border border-white" style="width: 100px;">Vào</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataGate as $k => $gate)
                            <tr class="root-tr {{ @$gate[0]->count_request == request()->id ? 'table-danger' : '' }}">
                                <td>
                                    <div class="directorist-select directorist-select-multi" id="multiSelect{{$k}}" data-isSearch="true" data-multiSelect='[
                                        <?php
                                            foreach($gate as $k => $item) {
                                                if (is_null(@$item->team->id)) {
                                                    echo '{"value": "'. $item->id ."__". @$item->user_id .' - '. @$item->team_id .'", "key": '. $k .'},';
                                                } else {
                                                    echo '{"value": "'. $item->id ."_". @$item->team->id ."--". @$item->user->last_name .' '. @$item->user->first_name .' - '. @$item->team->name .'", "key": '. $k .'},';
                                                }
                                            }
                                            ?>
                                        ]' data-max="5">
                                        <select name="mySelect" >
                                            <option value="">Select Item</option>
                                            @foreach($gate as $k => $item)
                                                @if (is_null(@$item->team->id))
                                                    <option value="{{$item->id .'__'. @$item->user_id .' - '. @$item->team_id }}">{{$item->id .'__'. @$item->user_id .' - '. @$item->team_id }}</option>
                                                @else
                                                    <option value="{{ $item->id .'_'. @$item->team->id .'--'. @$item->user->last_name .' '. @$item->user->first_name .' - '. @$item->team->name }}">{{ $item->id .'_'. @$item->team->id .'--'. @$item->user->last_name .' '. @$item->user->first_name .' - '. @$item->team->name }}</option>
                                                @endif
                                            @endforeach
                                            @foreach($datasUserAndArea as $key => $item)
                                                <option value="{{$item}}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <!-- <span class="text-danger show-error-name mt-1 d-flex"></span> -->
                                    <p class="text-danger d-flex" id="name" class="name"></p>
                                </td>
                                <td>
                                    <select class="department form-select is-team" name="department" aria-label="Default select example">
                                        <option value="">Chọn đơn vị ngoài</option>
                                        @foreach ($department as $key => $data)
                                            <option value="{{ $data->id }}" @if($data->id == @$gate[0]->team_id) selected @endif>{{ $data->name }}</option>
                                        @endforeach
                                        <option value="">{{ $gate[0]->team_id }}</option>
                                    </select>
                                </td>
                                <td>
                                    @if(is_null(@$gate[0]->staff_out))
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input justify-content-center" name="staff_out" type="checkbox">
                                        </div>
                                    @else
                                        <span><b>{{ date('H:i:s', strtotime(@$gate[0]->staff_out)) }}</b></span>
                                    @endif
                                </td>
                                <td>
                                    @if(is_null(@$gate[0]->staff_in))
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input justify-content-center" name="staff_in" type="checkbox">
                                        </div>
                                    @else
                                        <span><b>{{ date('H:i:s', strtotime(@$gate[0]->staff_in)) }}</b></span>
                                    @endif
                                </td>
                                <td>
                                    @if(is_null(@$gate[0]->student_out))
                                        <input class="form-control" name="student_out" type="number" min="0">
                                    @elseif(@$gate[0]->count_request == request()->id)
                                        <input class="form-control" name="student_out" value="{{ @$gate[0]->student_out }}" type="number" min="0">
                                    @else
                                        <span><b>{{ @$gate[0]->student_out }}</b></span>
                                    @endif
                                </td>
                                <td>
                                    @if(is_null(@$gate[0]->student_in))
                                        <input class="form-control" name="student_in" type="number" min="0">
                                    @elseif(@$gate[0]->count_request == request()->id)
                                        <input class="form-control" name="student_in" value="{{ @$gate[0]->student_in }}" type="number" min="0">
                                    @else
                                        <span><b>{{ @$gate[0]->student_in }}</b></span>
                                    @endif
                                </td>
                                <td>
                                    <textarea class="form-control note" style="height:50px">{{@$gate[0]->note}}</textarea>
                                </td>
                                <td>
                                    <select class="myselect form-select" name="gate_note" aria-label="Default select example">
                                        <option value="">Chọn công việc</option>
                                        @foreach ($gateNote as $key => $data)
                                            <option value="{{ $data->id }}" @if($data->id == @$gate[0]->gate_note_id) selected @endif>{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger mt-1" id="gate_note"></p>
                                </td>
                                <td>
                                    @if((!empty(@$gate[0]->staff_out) || !empty(@$gate[0]->staff_in)) && @$gate[0]->count_request != request()->get('update'))
                                        <a href="{{ route('gate.show', [ 'the_end' => $gate[0]->count_request ]) }}" class="btn btn-dark btn-sm mb-1">Kết thúc</a>
                                    @endif

                                    @if(@$gate[0]->id && @$gate[0]->count_request != request()->id)
                                        <!-- <button type="button" onclick="clickUpdated(this)"  class="btn btn-warning is-updated">Sửa</button> -->
                                        <a href="{{ route('gate.show', @$gate[0]->count_request) }}?update={{ @$gate[0]->count_request }}" class="btn btn-warning">Sửa</a>
                                    @else
                                        <button id="{{ @$gate[0]->count_request }}" type="button" class="btn btn-success is-finished">Xong</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
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
<style>
    .search-bar {
        min-width: 360px;
        padding: 0 20px;
    }
    .search-form button i {
        color: #012970;
    }
    .search-form button {
        border: 0;
        padding: 0;
        margin-left: -30px;
        background: none;
    }
    .search-form input {
        border: 0;
        font-size: 14px;
        color: #012970;
        border: 1px solid rgba(1, 41, 112, 0.2);
        padding: 7px 38px 7px 8px;
        border-radius: 3px;
        transition: 0.3s;
        width: 100%;
    }
    #table1 thead.fixedToTop {
        position: sticky;
        top:60px;
        z-index: 10000;
    }

    #table1 thead + .content{
        margin-top:8rem;
    }
    #table1 thead tr th {
        /* background-color: red; */
    }
    .is-pointer-events {
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('js/script.js') }}"></script>

<script>
    $(".is-add").click(function() {
        let countTr = $('#table1 tbody tr').length + 1;
        let zindex = $(".directorist-select").length + 1;

        let htmlData = `<tr class="root-tr">
                <td style="max-width: 150px;">
                    <div style="z-index:${zindex}" class="directorist-select directorist-select-multi" id="multiSelect${countTr}" data-isSearch="true" data-max="5" data-multiSelect="[]">
                        <select name="mySelect">
                            <option value="">Select Item</option>
                            <?php foreach($datasUserAndArea as $data) { ?>
                                <option value="<?php echo @$data ?>"><?php echo @$data ?></option>
                            <?php } ?>
                            ?>
                        </select>
                    </div>
                    <p class="text-danger d-flex" id="name" class="name"></p>
                </td>
                <td>
                    <select id="select-area${countTr}" class="department form-select is-team" name="department" aria-label="Default select example">
                        <option value="">Chọn đơn vị ngoài</option>
                        <?php foreach($department as $data) { ?>
                            <option value="<?php echo @$data->name ?>"><?php echo @$data->name ?></option>
                        <?php } ?>
                        ?>
                    </select>
                </td>
                <td>
                    <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input justify-content-center" name="staff_out" type="checkbox">
                    </div>
                    <p class="text-danger d-flex" id="staff" class="staff"></p>
                </td>
                <td>
                    <div class="form-check d-flex justify-content-center">
                        <input class="form-check-input justify-content-center" name="staff_in" type="checkbox">
                    </div>
                </td>
                <td>
                    <input class="form-control" name="student_out" type="number" min="0">
                </td>
                <td>
                    <input class="form-control" name="student_in" type="number" min="0">
                </td>
                <td>
                    <textarea class="form-control note" style="height:50px"></textarea>
                </td>
                <td>
                    <select id="select-job${countTr}" class="myselect form-select select-job" name="gate_note" aria-label="Default select example">
                        <option value="">Chọn công việc</option>
                        <?php foreach($gateNote as $key => $data) { ?>
                            <option value="<?php echo  $data->id; ?>" <?php if($data->id == @$gate[0]->gate_note_id) echo 'selected' ?>><?php echo $data->name; ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-danger mt-1" id="gate_note"></p>
                </td>
                <td>
                    <button type="button" onclick="clickFinished(this)" class="btn btn-primary is-finished">Xong</button>
                </td>
            </tr>`;

        if ($('#table1 tbody tr:last').length == 0) {
            $('#table1 tbody').append(`${htmlData}`);
        } else {
            $('#table1 tbody tr:first').before(`${htmlData}`);
        }
        function addFunction(el) {
            return pureScriptSelect(el);
        }
        
        addFunction(`#multiSelect${countTr}`);

        $("#select-area"+ countTr).select2({
            // tags: true,
            escapeMarkup: function (markup) {
                return markup;
            }
        });

        $("#select-job"+ countTr).select2();
        
    });

    $(".is-updated").click(function() {

    });

    function clickFinished(that) {
        data = $(that).closest('.root-tr').find('.is-name span');
        let dataName = [];
        
        if (data.length == 0) {
            dataName = $($(that).closest('.root-tr').children().find('.is-name')).next().val();
        } else {
            data.each(function( index, value ) {
                const name_staff = {};
                var regex = /\d+(.*?)\d+/gm.exec($(value).text());
                name_staff.user_id = regex[0].split("_")[0];
                name_staff.team_id = regex[0].split("_")[1];

                dataName.push(name_staff);
            });
        }

        team = $(that).closest('.root-tr').find('.is-team').val().trim();
        staffOut =  $(that).closest('.root-tr').find('input[name="staff_out"]:checked').length > 0 ? 1 : 0;
        staffIn = $(that).closest('.root-tr').find('input[name="staff_in"]:checked').length > 0 ? 1 : 0;
        studentOut = $(that).closest('.root-tr').find('input[name="student_out"]').val();
        studentIn = $(that).closest('.root-tr').find('input[name="student_in"]').val();
        note = $(that).closest('.root-tr').find('.note').val();
        gateNote = $(that).closest('.root-tr').find("select[name='gate_note']").val();

        $(that).closest('.root-tr').find("#name").html("");
        $(that).closest('.root-tr').find("#gate_note").html("");
        $(that).closest('.root-tr').find("#staff").html("");

        $.ajax({
            url : "{{ route('gate.add') }}",
            context: that,
            data : {
                "_token": "{{ csrf_token() }}",
                name: dataName,
                team: team,
                staff_out: staffOut,
                staff_in: staffIn,
                student_out: studentOut,
                student_in: studentIn,
                note: note.trim(),
                gate_note: gateNote,
            },
            type : 'POST',
            dataType : 'json',
            success : function(result) {
                console.log(result);
                toastr.success('Tạo phiếu thành công');
                // $(this).closest('.root-tr').find("input,textarea,select").attr("disabled", "disabled");
                // $(this).closest('.root-tr').find('.directorist-select__container').addClass("is-pointer-events");
                //     window.location.reload();
                $(this).parent().html(`<a href="/admin/gate/show/${result.data.count_request}/?update=${result.data.count_request}" class="btn btn-warning">Sửa</a>`);
                $(this).remove();
            },
            error: function (data) {
                if (data.status == 422) {
                    let resp = data.responseJSON.errors;
                    
                    for (index in resp) {
                        $("#" + index).html(resp[index]);
                    }
                } else {
                    toastr.error('Thất bại '+ data.responseJSON.message)
                }
            }
        });
    }

    function clickUpdated(that) {
        console.log(that);
        
        $(that).closest('.root-tr').find("input,textarea,select").removeAttr("disabled");
        $(that).closest('.root-tr').find('.directorist-select__container').removeClass("is-pointer-events");
    }

    $(document).ready(function() {
        var prevScrollpos = window.pageYOffset;

        /* Get the header element and it's position */
        var headerDiv = document.querySelector("#table1 thead");
        var headerBottom = headerDiv.offsetTop + headerDiv.offsetHeight;

        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;

            /* if scrolling down, let it scroll out of view as normal */
            if (prevScrollpos >= currentScrollPos ){
                headerDiv.classList.remove("fixedToTop");
            } else {
                headerDiv.classList.add("fixedToTop");
            }

            prevScrollpos = currentScrollPos;
        }

        $(".root-tr").each(function(k) {
            pureScriptSelect(`#multiSelect${k+1}`);
            // $(this).find("input,textarea,select").attr("disabled", "disabled");
            // $(this).find('.directorist-select__container').addClass("is-pointer-events");
        })
    
        let i = <?php echo count($dataGate); ?>;
        $(".directorist-select").each(function(k, v) {
            $(this).css('z-index', i)
            i--;
        });

        $(".myselect").select2();
        $(".department").select2({
            tags: true,
            escapeMarkup: function (markup) {
                return markup;
            }
        });

        $(".is-finished").click(function() {
            team = $(this).closest('.root-tr').find('.is-team').val().trim();
            staffOut =  $(this).closest('.root-tr').find('input[name="staff_out"]:checked').length > 0 ? 1 : 0;
            staffIn = $(this).closest('.root-tr').find('input[name="staff_in"]:checked').length > 0 ? 1 : 0;
            studentOut = $(this).closest('.root-tr').find('input[name="student_out"]').val();
            studentIn = $(this).closest('.root-tr').find('input[name="student_in"]').val();
            note = $(this).closest('.root-tr').find('.note').val();
            gateNote = $(this).closest('.root-tr').find("select[name='gate_note']").val();

            console.log('team', team);
            console.log('staffOut', staffOut);
            console.log('staffIn', staffIn);
            console.log('studentOut', team);
            console.log('note', note);
            console.log('gateNote', gateNote);
            
            $.ajax({
                url : "{{ route('gate.updateOutAndIn') }}",
                context: this,
                data : {
                    "_token": "{{ csrf_token() }}",
                    staff_out: staffOut,
                    staff_in: staffIn,
                    student_out: studentOut,
                    student_in: studentIn,
                    note: note.trim(),
                    gate_note_id: gateNote,
                    count_request: $(this).attr('id')
                },
                type : 'POST',
                dataType : 'json',
                success : function(result) {
                    toastr.success('Cập nhật thành công');
                    console.log(result);

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    
                    // toastr.success('Tạo phiếu thành công');
                    // $(this).closest('.root-tr').find("input,textarea,select").attr("disabled", "disabled");
                    // $(this).closest('.root-tr').find('.directorist-select__container').addClass("is-pointer-events");
                    //     window.location.reload();

                },
                error: function (data) {
                   console.log('error', data);
                   
                }
            });
        });
    });
  
</script>
@endpush
