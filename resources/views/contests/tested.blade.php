@section('title','Danh sách VC-NLĐ đã thi pháp luật')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH VC-NLĐ ĐÃ THI PHÁP LUẬT</h1>

   {{ Breadcrumbs::render('contest.tested', $contest) }}

@endsection

@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Đã thi</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Chưa thi</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Miễn thi</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Họ tên</th>
                                        <th scope="col">Bộ phận</th>
                                        <th scope="col">Số điểm</th>
                                        <th scope="col">Dự đoán</th>
                                        <th scope="col">Thời gian nộp bài</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usersExitsInLawResult as $k => $items)
                                    <tr>
                                        <th scope="row">{{++$k}}</th>
                                        <td>{{$items->last_name}} {{$items->first_name}}</td>
                                        <td>{{ $items->team->name }}</td>
                                        @php
                                        $count = 0;
                                        foreach($items->answers as $item) {
                                            if ($item->result == \App\Models\Answer::CORRECT) {
                                                $count++;
                                            }
                                        }
                                        @endphp
                                        <td>{{ $count .'/'. count($items->answers) }}</td>
                                        <td>
                                            @foreach($predict as $item)
                                                @if ($item->user_id == $items->id)
                                                    {{ $item->answer }}
                                                    @break;
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($lawResults as $item)
                                                @if($item->user_id == $items->id)
                                                    {{ $item->time }}
                                                    @break;
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Bộ phận</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($usersYetTest as $k => $item)
                                    <tr>
                                        <th scope="row">{{++$k}}</th>
                                        <td>{{$item->last_name}} {{$item->first_name}}</td>
                                        <td>{{ $item->team->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Bộ phận</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($userFreeContest as $k => $item)
                                    <tr>
                                        <th scope="row">{{ ++$k }}</th>
                                        <td>{{ $item->last_name }} {{ $item->first_name }}</td>
                                        <td>{{ $item->team->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <a href="{{ route('contest.export', $contest->id) }}" type="button" class="btn btn-success btn-sm mt-1">Xuất Excel</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th style="min-width: 100px" scope="col">Họ tên</th>
                                <th style="min-width: 100px" scope="col">Bộ phận</th>
                                @foreach($usersExitsInLawResult as $k => $items)
                                    @foreach($items->answers as $kk => $item)
                                        <th scope="col" style="min-width: 400px">
                                            Câu: {{ $item->question_id }}: {{$item->question_name}}
                                        </td>
                                    @endforeach
                                    @break;
                                @endforeach
                                <th style="min-width: 100px" scope="col">Dự đoán</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usersExitsInLawResult as $k => $items)
                            <tr>
                                <th scope="row">{{++$k}}</th>
                                <td>{{$items->last_name}} {{$items->first_name}}</td>
                                <td>{{ $items->team->name }}</td>

                                @foreach($items->answers as $kk => $item)
                                @php
                                $char = strtolower($item->answer);
                                @endphp
                                    <td class="{{ $item->$char ==  $item->answer1 ? 'text-danger' : '' }}">
                                       {{ $item->answer1 }}
                                    </td>
                                @endforeach
                                <td>
                                    @foreach($predict as $item)
                                        @if ($item->user_id == $items->id)
                                            {{ $item->answer }}
                                            @break;
                                        @endif
                                    @endforeach
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