@section('title','Thi Pháp Luật')
@extends('layouts.template')

@section('breadcrumb')

   <h1>THI PHÁP LUẬT</h1>

   {{ Breadcrumbs::render('contest.law.index', $contest) }}

@endsection

@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên câu hỏi</th>
                    <th scope="col">A</th>
                    <th scope="col">B</th>
                    <th scope="col">C</th>
                    <th scope="col">D</th>
                    <th scope="col">Ngẫu nhiên</th>
                    <th scope="col">Điểm</th>
                    <th scope="col">Đáp án</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($listQuestion as $key => $item)
                    <tr>
                        <th scope="row">{{ ++ $key }}</th>
                        <td><b>{{ $item->question_name }}</b></td>
                        <td class="{{ $item->answer == 'A' ? 'text-danger' : '' }}">{{ $item->a }}</td>
                        <td class="{{ $item->answer == 'B' ? 'text-danger' : '' }}">{{ $item->b }}</td>
                        <td class="{{ $item->answer == 'C' ? 'text-danger' : '' }}">{{ $item->c }}</td>
                        <td class="{{ $item->answer == 'D' ? 'text-danger' : '' }}">{{ $item->d }}</td>
                        <td>{{ $item->random == 1 ? 'Lộn xộn' : 'Tuần tự' }}</td>
                        <td>{{ $item->point }}</td>
                        <td>{{ $item->answer }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection