@section('title','Danh sách người dùng')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH NGƯỜI DÙNG</h1>

   {{ Breadcrumbs::render('user.list') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
      <div class="col-lg-8">
         <div class="card pt-3">
            <div class="card-body table-responsive">
               <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên cuộc thi</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Người tạo</th>
                    <th scope="col">Thời gian làm bài</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">
                        <a href="{{ route('contest.create') }}" type="button" class="btn btn-primary">Thêm</a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $contest)
                    <tr>
                        <th scope="row">{{ $key + 1}}</th>
                        <td>
                            <a href="{{ route('contest.law.create', $contest->id) }}">{{ $contest->name}}</a>
                        </td>
                        <td>{{ $contest->description}}</td>
                        <td>{{ $contest->user->last_name }} {{ $contest->user->first_name }}</td>
                        <td>{{ $contest->time_test }} phút</td>
                        <td>{!! $contest->status == 1 ? '<span class="badge rounded-pill bg-success">Đang mở</span>' : '<span class="badge rounded-pill bg-danger">Đã đóng</span>'!!}</td>
                        <td>{{ $contest->created_at}}</td>
                        <td>
                            <a href="{{route('contest.edit', $contest->id)}}" class="btn btn-warning">Sửa</a>
                            <a href="{{ route('contest.tested', $contest->id) }}" type="button" class="btn btn-dark">Xem</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection