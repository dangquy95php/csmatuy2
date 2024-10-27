@section('title','Danh sách cuộc thi')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH CUỘC THI</h1>

   {{ Breadcrumbs::render('contest.index') }}

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
                    <th scope="col">Đường dẫn</th>
                    <th scope="col">Thời gian làm bài</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">
                        <a href="{{ route('contest.create') }}" type="button" class="btn btn-primary btn-sm">Thêm</a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $contest)
                    <tr>
                        <th scope="row">{{ $key + 1}}</th>
                        <td>
                        </td>
                        <td>{{ $contest->description}}</td>
                        <td>{{ $contest->user->last_name }} {{ $contest->user->first_name }}</td>
                        <td>
                           <a target="_blank" href="{{ $contest->link }}" class="text-danger">{{ $contest->link }}</a>
                        </td>
                        <td>{{ $contest->time_test }} phút</td>
                        <td>{!! $contest->status == 1 ? '<span class="badge rounded-pill bg-success">Đang mở</span>' : '<span class="badge rounded-pill bg-danger">Đã đóng</span>'!!}</td>
                        <td>{{ $contest->created_at}}</td>
                        <td>
                           @if (App\Models\LawQuestions::where('contest_id', $contest->id)->count() > 0)
                              <a href="{{route('law.question.edit', $contest->id)}}" class="btn btn-success btn-sm">Chỉnh sửa câu hỏi</a>
                           @else
                              <a href="{{route('law.question.create', $contest->id)}}" class="btn btn-success btn-sm">Tạo câu hỏi</a>
                           @endif
                           <a href="{{route('contest.edit', $contest->id)}}" class="btn btn-warning btn-sm mt-1">Sửa cuộc thi</a>
                           <a href="{{ route('contest.tested', $contest->id) }}" type="button" class="btn btn-dark btn-sm mt-1">Kết quả</a>
                           <a href="{{ route('contest.law.question', $contest->id) }}" type="button" class="btn btn-danger btn-sm mt-1">Đáp án câu hỏi</a>
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