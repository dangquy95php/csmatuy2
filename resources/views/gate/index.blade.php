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
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ Request::get('tab') == 'tab1' ? 'active' : '' }} {{ empty(Request::get('tab')) ? 'active' : '' }}" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Danh sách cán bộ Ra/Vào</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ Request::get('tab') == 'tab2' ? 'active' : '' }}" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Danh sách người thân của người cai nghiện đưa lên</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ Request::get('tab') == 'tab3' ? 'active' : '' }}" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Khách đưa quân lên</button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane {{ Request::get('tab') == 'tab1' ? 'show active' : 'fade' }} {{ empty(Request::get('tab')) ? 'show active' : '' }}" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-lg-9">
                        <form id="form-staff" action="" method="get">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <div class="row">
                                        <label for="inputPassword" class="col-sm-5 col-form-label">Ngày bắt đầu:</label>
                                        <div class="col-sm-6">
                                            <input type="date" value="{{ \Request::get('staff_start_date') }}" name="staff_start_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <label for="inputPassword" class="col-sm-5 col-form-label">Ngày kết thúc:</label>
                                        <div class="col-sm-6">
                                            <input type="date" value="{{ \Request::get('staff_end_date') }}" name="staff_end_date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="row">
                                        <select class="form-select" name="type_gate" aria-label="Default select example">
                                            @foreach(\App\Models\Gate::INFOR_GATE as $key => $value)
                                                <option {{ $key == Request::get('type_gate') ? 'selected' : '' }}  value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                    <button type="button" {{Request::get('staff_today') ? 'disabled' : ''}} class="btn btn-success today-search">Hôm nay</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên nhân viên</th>
                                    <th class="text-center" scope="col">Số người cai nghiện</th>
                                    <th scope="col">Ghi chú</th>
                                    <th scope="col">Loại hình</th>
                                    <th scope="col">Bộ phận</th>
                                    <th scope="col">Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $id = 1;
                                @endphp
                                @foreach ($data as $key => $gates)
                                    @foreach ($gates as $k => $gate)
                                    <tr>
                                        <th scope="row">{{ $id }}</th>
                                        <td>
                                            {{ $gate->user->name }}
                                        </td>
                                        @php
                                            $html = '<span class="badge rounded-pill bg-danger">';
                                            $html .=  $gate->number_of_drug_addicts;
                                            $html .= '</span>';
                                        @endphp
                                        @if (isset($gate->rowspan))
                                        <td rowspan="{{ @$gate->rowspan }}" class="text-center align-middle">
                                            {!! (empty($gate->number_of_drug_addicts)) ? '' : $html !!}
                                        </td>
                                        <td rowspan="{{ @$gate->rowspan }}" class="align-middle">{{ $gate->note }}</td>
                                        <td rowspan="{{ @$gate->rowspan }}" class="align-middle">{!! $gate->type_gate == 0 ? '<span class="badge rounded-pill bg-danger">Ra cổng</span>' : '<span class="badge rounded-pill bg-success">Vào cổng</span>' !!}</td>
                                        @endif

                                        <td>{{ $gate->team->name }}</td>
                                        @if (isset($gate->rowspan))
                                        <td rowspan="{{ @$gate->rowspan }}" class="align-middle">{{ $gate->created_at }}</td>
                                        @endif
                                    </tr>
                                    @php
                                    $id ++;
                                    @endphp
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
                <div class="tab-pane {{ Request::get('tab') == 'tab2' ? 'show active' : 'fade' }}" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-lg-10">
                        <table class="table table-bordered" id="sortTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-center">Tên thân nhân</th>
                                    <th scope="col">Loại cổng</th>
                                    <th scope="col">Ghi chú</th>
                                    <th scope="col" class="type-gate">Loại hình</th>
                                    <th scope="col">Tên người cai nghiện</th>
                                    <th scope="col">Bản số xe</th>
                                    <th scope="col" class="time-title">Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drugAddict as $key => $item)
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td><b>{{ $item->personal_name }}</b></td>
                                    <td>{!! $item->type_gate == 0 ? '<span class="badge rounded-pill bg-danger">Ra cổng</span>' : '<span class="badge rounded-pill bg-success">Vào cổng</span>' !!}</td>
                                    <td>{{ $item->note }}</td>
                                    <td>{!! $item->kind_of_detox == 1 ? '<span class="badge rounded-pill bg-warning text-dark">Bắt buộc</span>' : '<span class="badge rounded-pill bg-info text-dark">Tự nguyện</span>' !!}</td>
                                    <td>{{ $item->name_of_drug_addict }}</td>
                                    <td>{{ $item->car_number }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                       {{ $drugAddict->links() }}
                    </div>
                </div>
                <div class="tab-pane {{ Request::get('tab') == 'tab3' ? 'show active' : 'fade' }}" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="col-lg-10">
                        <table class="table table-bordered" id="sortTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-center">Tên thân nhân</th>
                                    <th scope="col">Ghi chú</th>
                                    <th scope="col" class="type-gate">Loại hình</th>
                                    <th class="text-center" scope="col">Số người cai nghiện</th>
                                    <th scope="col">Bản số xe</th>
                                    <th scope="col" class="time-title">Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guestStudent as $key => $item)
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td><b>{{ $item->staff_name }}</b></td>
                                    <td>{{ $item->note }}</td>
                                    <td>{!! $item->type_gate == 0 ? '<span class="badge rounded-pill bg-danger">Ra cổng</span>' : '<span class="badge rounded-pill bg-success">Vào cổng</span>' !!}</td>
                                    <td class="text-center">{{ $item->number_of_drug_addicts }}</td>
                                    <td>{{ $item->car_number }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- End Bordered Tabs -->

            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
  <style>
    .border-bottom-style {
        border-bottom-style: hidden;
    }
  </style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $(".today-search").click(function() {
        $("#form-staff").append('<input type="text" name="staff_today" value="today" />');
        $('#form-staff').submit();
    });

    $('.time-title').click(function() {
        sortTable("time-title", this);
    });
    $('.type-gate').click(function() {
        sortTable("type-gate", this);
    });
});
</script>
@endpush()
