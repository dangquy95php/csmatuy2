@section('title','Danh sách cán bộ vào ra cổng')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH CÁN BỘ VÀO RA CỔNG</h1>

   {{ Breadcrumbs::render('gate.input') }}

@endsection


@section('content')

<section class="section">
   <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Đã vào cổng</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Chưa vào cổng</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="borderedTabContent">
                        <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên nhân viên</th>
                                        <th scope="col">Thời gian vào</th>
                                        <th scope="col">Số học viên vào</th>
                                        <th scope="col">Ghi chú</th>
                                        <th scope="col">Đơn vị</th>
                                        <th scope="col">Loại công việc</th>
                                        <th scope="col">Người nhập</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($todayIn as $k => $item)
                                    <tr>
                                        <th scope="row">{{ ++$k }}</th>
                                        <td>{{ $item->user->last_name }} {{ $item->user->first_name }}</td>
                                        <td>{{ date('H:i:s', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->student_out }}</td>
                                        <td>{{ $item->note }}</td>
                                        <td>{{ $item->team->name }}</td>
                                        <td>{{ $item->gate_note->name }}</td>
                                        <td>{{ $item->auth->last_name }} {{ $item->auth->first_name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $todayIn->links('_partials.pagination') !!}
                        </div>
                        <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="col-lg-6">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên nhân viên</th>
                                            <th scope="col">Đơn vị</th>
                                            <th scope="col">Hình ảnh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listNotYetIn as $key => $item)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $item->last_name }} {{ $item->first_name }}</td>
                                            <td>{{ @$item->team->name }}</td>
                                            <td>
                                                <img data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key + 1 }}" src="{{ !file_exists('storage/profile/'.$item->image) || empty($item->image) ? asset('storage/profile/default.jpg') : asset('storage/profile/'.$item->image)}}" style="width:70px;" class="img-fluid img-thumbnail" alt="">
                                                <div class="modal fade" id="exampleModal{{ $key + 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{{ $item->team ? $item->team->name : 'Không thuộc team' }}: <b>{{ $item->name }}</b></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img class="img-fluid w-100" src="{{ !file_exists('storage/profile/'.$item->image) || empty($item->image) ? asset('storage/profile/default.jpg') : asset('storage/profile/'.$item->image) }}" alt="">
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $todayIn->links('_partials.pagination') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection