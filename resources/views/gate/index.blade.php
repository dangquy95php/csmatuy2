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
                        <a href="{{route('gate.index')}}" class="card-title">Cổng ngày: <b class="time-now text-danger">{{ date('d-m-Y') }}</b></a>    
                        <div class="search-bar">
                            <form class="search-form d-flex align-items-center" method="GET" action="">
                                <input type="text" name="search" value="{{ request()->query('search') }}" placeholder="Tìm kiếm" title="Tìm kiếm">
                                <button type="submit" title="Tìm kiếm"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <table id="table1" class="table table-bordered border-danger table-hover">
                        <thead>
                            <tr>
                                <th rowspan="2" class="align-middle text-center w-25 bg-primary text-white border border-white">Họ và tên</th>
                                <th class="align-middle text-center bg-primary text-white border border-white" colspan="2">Cán bộ</th>
                                <th class="align-middle text-center bg-primary text-white border border-white" colspan="2">Học viên</th>
                                <th rowspan="2" class="align-middle text-center bg-primary text-white border border-white">Ghi chú</th>
                                <th style="width:250px;" rowspan="2" class="align-middle text-center bg-primary text-white border border-white">Công việc</th>
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
                            @php
                            $index = 1;
                            @endphp
                            @foreach($dataGate as $k => $gates)
                            <tr class="root-tr">
                                <td class="is-pointer-events1">
                                    <select style="width:100%;" class="employer" multiple="" tabindex="-1" aria-hidden="true">
                                        @foreach($dataEmployer as $k => $items)
                                            <optgroup class="select2-result-selectable" label="{{ $items->text }}">
                                                @foreach($items->children as $key => $child)
                                                    @php
                                                    $flag = false;
                                                    @endphp
                                                    @foreach($gates as $kk => $gate)
                                                        @if ($gate->user_id == $child->id && $gate->team_id == $child->area_id)
                                                            <option value="{{ $child->text }}" selected>{{ $child->text }} - {{ $child->area }}</option>
                                                            @php
                                                            $flag = true;
                                                            @endphp
                                                        @endif
                                                    @endforeach

                                                    @if ($flag == false)
                                                        <option value="{{ $child->text }}">{{ $child->text }} - {{ $child->area }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    <p class="text-danger d-flex" id="employers"></p>
                                </td>
                                
                                <td class="is-pointer-events">
                                    <input type="time" step="2" name="staff_out" class="staff_out form-control" value="{{ !empty(@$gates[0]->staff_out) ? date('H:i:s', strtotime(@$gates[0]->staff_out)) : '' }}">
                                    <span class="text-danger d-flex" id="staff"></span>
                                </td>
                                <td class="is-pointer-events">
                                    <input type="time" step="2" name="staff_in" class="staff_in form-control" value="{{ !empty(@$gates[0]->staff_in) ? date('H:i:s', strtotime(@$gates[0]->staff_in)) : '' }}">
                                </td>
                                <td class="is-pointer-events">
                                    <input class="form-control" name="student_out" value="{{ @$gates[0]->student_out }}" type="number" min="0">
                                </td>
                                <td class="is-pointer-events">
                                    <input class="form-control" name="student_in" value="{{ @$gates[0]->student_in }}" type="number" min="0">
                                </td>
                                <td class="is-pointer-events">
                                    <textarea class="form-control" name="note" style="height:50px">{{@$gates[0]->note}}</textarea>
                                </td>
                                <td class="is-pointer-events">
                                    <select class="form-select select_job{{ $index }}" name="gate_note" aria-label="Default select example">
                                        <option value="">Chọn công việc</option>
                                        @foreach ($gateNote as $key => $data)
                                            <option value="{{ $data->id }}" @if($data->id == @$gates[0]->gate_note_id) selected @endif>{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger mt-1" id="gate_note_id"></p>
                                </td>
                                <td>
                                    <button type="button" count_request="{{ $gates[0]->count_request }}" onClick="btnKetthuc(this)" class="btn btn-secondary btn-sm btn-ketthuc">Kết thúc</button>
                                    <button type="button" count_request="{{ $gates[0]->count_request }}" onClick="btnSua(this)" class="btn btn-warning btn-sm btn-sua">Sửa</button>
                                </td>
                            </tr>
                            @php
                            $index++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content" style="width: 48px">
                                <span class="spinner-border text-dark"></span>
                            </div>
                        </div>
                    </div>
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
    .bd-example-modal-lg .modal-dialog{
        display: table;
        position: relative;
        margin: 0 auto;
        top: calc(50% - 24px);
    }
    
    .bd-example-modal-lg .modal-dialog .modal-content{
        background-color: transparent;
        border: none;
    }
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
    /* #table1 thead.fixedToTop {
        position: sticky;
        top:60px;
        z-index: 10000;
    } */

    #table1 thead + .content{
        margin-top:8rem;
    }
    #table1 thead tr th {
        /* background-color: red; */
    }
    .is-pointer-events, .is-pointer-events1 {
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
<script>
    function getTimeStaff(that) {
        var d = new Date(),        
            h = d.getHours(),
            m = d.getMinutes();
            s = d.getSeconds();
        if(h < 10) h = '0' + h; 
        if(m < 10) m = '0' + m;
        if(s < 10) s = '0' + s;
        $(that).prev().val(h + ':' + m + ':'+ s);
    }

    function btnKetthuc(that) {
        let id = $(that).attr('count_request');
        staffOut =  $(that).closest('.root-tr').find('input[name="staff_out"]').val();
        staffIn = $(that).closest('.root-tr').find('input[name="staff_in"]').val();

        $(that).closest('.root-tr').find("#staff_out").html("");
        $(that).closest('.root-tr').find("#staff_in").html("");

        $.ajax({
            url : "{{ route('gate.end') }}",
            context: that,
            data : {
                "_token": "{{ csrf_token() }}",
                staff_out: staffOut,
                staff_in: staffIn,
                count_request: id,
            },
            type : 'POST',
            dataType : 'json',
            success : function(result) {
                toastr.success('Kết thúc thành công');
                $(that).closest('.root-tr').remove();
            },
            error: function (data) {
                if (data.status == 422) {
                    let resp = data.responseJSON.errors;

                    for (index in resp) {
                        $("#staff").html(resp[index]);
                    }
                } else {
                    toastr.error('Thất bại '+ data.responseJSON.message)
                }
            }
        });
    }

    $(".is-add").click(function() {
        let countTr = $('#table1 tbody tr').length + 1;
        if ($('#table1 tbody tr').length > 0) {
            var selected = $($('#table1 tbody tr')[0]).find('select[name="gate_note"] option:selected')[0].getAttribute("value");
        }

        let htmlData = `<tr class="root-tr">
                <td style="max-width: 150px;">
                    <select name="employers[]" class="select_employer${countTr} form-select" aria-label="Default select example"></select>
                    <p class="text-danger d-flex" id="employers"></p>
                </td>
                <td>
                    <input type="time" name="staff_out" class="form-control" step="2">
                    <button type="button" class="btn btn-primary btn-sm text-sm-left p-0 ps-1 pe-1" onClick=getTimeStaff(this)>Lấy thời gian</button>
                    <span class="text-danger d-flex" id="staff"></span>
                </td>
                <td>
                    <input type="time" name="staff_in" class="form-control" step="2">
                    <button type="button" class="btn btn-primary btn-sm text-sm-left p-0 ps-1 pe-1" onClick=getTimeStaff(this)>Lấy thời gian</button>
                </td>
                <td>
                    <input class="form-control" name="student_out" type="number" min="0">
                </td>
                <td>
                    <input class="form-control" name="student_in" type="number" min="0">
                </td>
                <td>
                    <textarea class="form-control note" name="note" style="height:50px"></textarea>
                </td>
                <td>
                    <select class="form-select select_job${countTr}" name="gate_note" aria-label="Default select example">
                        <option value="">Chọn công việc</option>
                        <?php foreach($gateNote as $data) { ?>
                            <option value="<?php echo @$data->id ?>"><?php echo @$data->name ?></option>
                        <?php } ?>
                        ?>
                    </select>
                    <p class="text-danger mt-1" id="gate_note_id"></p>
                </td>
                <td>
                    <button type="button" onclick="clickFinished(this)" class="btn btn-primary">Xong</button>
                </td>
            </tr>`;
      
        if ($('#table1 tbody tr:last').length == 0) {
            $('#table1 tbody').append(`${htmlData}`);
        } else {
            $('#table1 tbody tr:first').before(`${htmlData}`);
            $($('#table1 tbody tr')[0]).find('select[name="gate_note"] option').each(function() {
                let id = $(this).val();
                if (id == selected) {
                    $(this).attr('selected', 'selected');
                }
            });
        }

        $(".select_job"+ countTr).select2({
            "language": {
                "noResults": function() {
                    return "Kết quả không tìm thấy";
                }
            },escapeMarkup: function (markup) {
                    return markup;
            }
        });

        $(".select_employer"+ countTr).select2({
            tags: true,
            multiple:true,
            maximumSelectionLength: 5,
            placeholder: 'Vui lòng chọn nhân viên',
            data: <?php echo json_encode($dataEmployer); ?>,
            templateSelection: function(selection) {
                if(selection.selected) {
                    return $.parseHTML(`<span class="is-employer" user_id="${selection.id}" team_id="${selection.area_id}">${selection.text} - ${selection.area}</span>`);
                }
                else {
                    return $.parseHTML(`<span class="is-employer" user_id="${selection.id}" team_id="${selection.area_id}">${selection.text} - ${selection.area}</span>`);
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            matcher: function(params, data){
                return modelMatcher(params, data);
            },
            language: {
                maximumSelected: function (e) {
                    return 'Chỉ chọn tối đa ' + e.maximum + " nhân viên";
                }
            }
        }).on("change", function (e) {
            var selected_element = $(e.currentTarget);
            var select_val = selected_element.data;
            
        });
    });

    function clickFinished(that) {
        $('.modal').modal('show');
        let datas = $(that).closest('.root-tr').find('.is-employer');
        const employersData = [];
        for(item of datas) {
            let employer = {};
            employer.user_id = $(item).attr('user_id');
            employer.team_id = $(item).attr('team_id');
            employersData.push(employer);
        }
        staffOut =  $(that).closest('.root-tr').find('input[name="staff_out"]').val();
        staffIn = $(that).closest('.root-tr').find('input[name="staff_in"]').val();
        studentOut = $(that).closest('.root-tr').find('input[name="student_out"]').val();
        studentIn = $(that).closest('.root-tr').find('input[name="student_in"]').val();
        note = $(that).closest('.root-tr').find('.note').val();
        gateNote = $(that).closest('.root-tr').find("select[name='gate_note']").val();

        $(that).closest('.root-tr').find("#employers").html("");
        $(that).closest('.root-tr').find("#gate_note_id").html("");
        $(that).closest('.root-tr').find("#staff").html("");
        $.ajax({
            url : "{{ route('gate.add') }}",
            context: this,
            data : {
                "_token": "{{ csrf_token() }}",
                employers: employersData,
                staff_out: staffOut,
                staff_in: staffIn,
                student_out: studentOut,
                student_in: studentIn,
                note: note.trim(),
                gate_note_id: gateNote,
            },
            type : 'POST',
            dataType : 'json',
            success : function(result) {
                toastr.success('Cập nhật thành công');
                $(that).parent().append(`<button type="button" onClick="btnSua(this)" count_request="${result.data.count_request}" class="btn btn-warning btn-sm btn-sua">Sửa</button>`);
                $(that).closest('.root-tr').find('td').each(function(k, value) {
                    if ($(that).closest('.root-tr').find('td').length - 1 > k) {
                        $(this).addClass('is-pointer-events');
                    }
                    if (k == 0)
                    $(this).addClass('is-pointer-events1');
                });
                $(`<button type="button" count_request="${result.data.count_request}"
                onClick="btnKetthuc(this)" class="btn btn-secondary btn-sm btn-ketthuc">Kết thúc</button>`).insertAfter($(that))

                $(that).remove();
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
            },
        });
        setTimeout(function () {
       	    $('.modal').modal('hide');
        }, 500);
    }

    function modelMatcher (params, data) {
        data.parentText = data.parentText || "";

        if ($.trim(params.term) === '') {
            return data;
        }

        if (data.children && data.children.length > 0) {
        var match = $.extend(true, {}, data);

        for (var c = data.children.length - 1; c >= 0; c--) {
            var child = data.children[c];
            child.parentText += data.parentText + " " + data.text;

            var matches = modelMatcher(params, child);

            if (matches == null) {
                match.children.splice(c, 1);
            }
        }

        if (match.children.length > 0) {
                return match;
            }

            return modelMatcher(params, match);
        }


        var original = (data.parentText + ' ' + data.first_name).toUpperCase();
        var term = params.term.toUpperCase();

        if (original.indexOf(term) > -1) {
            return data;
        }

        return null;
    }

    function btnSua(that) {
        let countRequest = $(that).attr('count_request');
        let data = $(that).closest('.root-tr').find('td');
        for(item of data) {
            $(item).removeClass('is-pointer-events');
        }
        let staffIn = $($(that).closest('.root-tr').find('input[name="staff_in"]'));
        let staffOut = $($(that).closest('.root-tr').find('input[name="staff_out"]'));
        staffIn.next().remove();
        staffOut.next().remove();

        $($(that).closest('.root-tr').find('input[name="staff_in"]')).parent().append(`<button type="button" class="btn btn-primary btn-sm text-sm-left p-0 ps-1 pe-1" onClick="getTimeStaff(this)">Lấy thời gian</button>`);
        $(`<button type="button" class="btn btn-primary btn-sm text-sm-left p-0 ps-1 pe-1" onClick="getTimeStaff(this)">Lấy thời gian</button>`).insertAfter($($(that).closest('.root-tr').find('input[name="staff_out"]')));
        
        $(that).parent().append(`<button type="button" onClick="updateGate(this, ${countRequest})" class="btn btn-danger btn-sm is-capnhat mt-1">Cập nhật</button>`);

        $($(that).closest('.root-tr').find('select[name="gate_note"]')).select2({
            "language": {
                "noResults": function() {
                    return "Kết quả không tìm thấy";
                }
            },escapeMarkup: function (markup) {
                    return markup;
            }
        });
        $(that).remove();
    }

    function updateGate(that, id) {
        $('.modal').modal('show');
        studentOut = $(that).closest('.root-tr').find('input[name="student_out"]').val();
        studentIn = $(that).closest('.root-tr').find('input[name="student_in"]').val();
        note = $(that).closest('.root-tr').find('textarea[name="note"]').val();
        gateNote = $(that).closest('.root-tr').find("select[name='gate_note']").val();
        staffIn = $(that).closest('.root-tr').find('input[name="staff_in"]').val();
        staffOut = $(that).closest('.root-tr').find('input[name="staff_out"]').val();
        
        $(that).closest('.root-tr').find("#employers").html("");
        $(that).closest('.root-tr').find("#gate_note_id").html("");
        $(that).closest('.root-tr').find("#staff").html("");
        $.ajax({
            url : "{{ route('gate.update') }}",
            context: that,
            data : {
                "_token": "{{ csrf_token() }}",
                staff_out: staffOut,
                staff_in: staffIn,
                student_out: studentOut,
                student_in: studentIn,
                note: note.trim(),
                gate_note_id: gateNote,
                count_request: id,
            },
            type : 'POST',
            dataType : 'json',
            success : function(result) {
                toastr.success('Cập nhật thành công');
                let staffIn = $($(that).closest('.root-tr').find('input[name="staff_in"]'));
                let staffOut = $($(that).closest('.root-tr').find('input[name="staff_out"]'));
                staffIn.next().remove();
                staffOut.next().remove();

                if (staffIn.val() != '' && staffOut.val() != '') {
                   $(that).closest('.root-tr').remove();
                }
                
                $(that).closest('.root-tr').find('td').each(function(k, value) {
                    if ($(that).closest('.root-tr').find('td').length - 1 > k) {
                        $(this).addClass('is-pointer-events');
                    }
                    if (k == 0)
                    $(this).addClass('is-pointer-events1');
                });

                $(that).parent().append(`<button type="button" onClick="btnSua(this)" count_request="${id}" class="btn btn-warning btn-sm btn-sua">Sửa</button>`);
                $(that).remove();
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
            },
        });
        setTimeout(function () {
       	    $('.modal').modal('hide');
        }, 500);
    }

    $(document).ready(function() {
        $(".employer").select2({
            tags: true,
            multiple:true,
            maximumSelectionLength: 5,
            placeholder: 'Vui lòng chọn nhân viên',
            matcher: function(params, data){
                return modelMatcher(params, data);
            },
        });

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
    });
  
</script>
@endpush
