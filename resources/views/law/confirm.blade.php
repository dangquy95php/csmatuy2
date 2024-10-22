@section('title','Xác nhận thông tin')
@extends('layouts.template')

@section('breadcrumb')

   <h1>XÁC NHẬN THÔNG TIN LÀM BÀI</h1>

   {{ Breadcrumbs::render('contest.confirm', $contest) }}

@endsection

@section('content')

<section class="section">
   <div class="row align-items-center h-100 justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body p-5">
                    <form action="" method="post">
                        <table class="table table-bordered border-primary mb-2">
                            <thead>
                                <tr>
                                    <th class="text-center" colspan="2" scope="col">{{ $contest->name}}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Tổng số câu hỏi</th>
                                    <th scope="col">Thời gian làm bài</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ count($data) + 1 }}</td>
                                    <td>{{ $contest->time_test }} phút</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Vào thi</button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
