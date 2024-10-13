@section('title','Tạo Cuộc thi')
@extends('layouts.template')

@section('breadcrumb')

   <h1>TẠO CUỘC THI</h1>

   {{ Breadcrumbs::render('contest.create') }}
   
@endsection

@section('content')

<section class="section">
   <div class="row">
    <div class="col-lg-6">
        <div class="card pt-3">
            <div class="card-body">
                <!-- Vertical Form -->
                <form class="row g-3" method="POST">
                @csrf
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Tên Cuộc thi:</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="inputNanme4">
                        @include('_partials.alert', ['field' => 'name'])
                    </div>
                    <div class="col-4">
                        <label for="inputNanme5" class="form-label">Thời gian làm bài: (Số phút)</label>
                        <input min="10" max="100" type="number" name="time_test" value="{{old('time_test')}}" class="form-control" id="inputNanme5">
                        @include('_partials.alert', ['field' => 'time_test'])
                    </div>
                    <div class="col-8">
                        <label for="inputNanme6" class="form-label">Trạng thái:</label>
                        <select class="form-select" name="status">
                            <option value="0" @if(0==old('status')) selected @endif>Đã đóng</option>
                            <option value="1" @if(1==old('status')) selected @endif>Đang mở</option>
                        </select>
                        @include('_partials.alert', ['field' => 'status'])
                    </div>
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Mô tả:</label>
                        <textarea class="form-control" name="description" placeholder="Vui lòng nhập ghi chú" id="floatingTextarea" style="height: 100px;"></textarea>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Tạo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   </div>
</section>
@endsection
