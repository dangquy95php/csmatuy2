@section('title','Danh sách cán bộ vào ra cổng')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH CÁN BỘ VÀO RA CỔNG</h1>

    <!-- Breadcrumbs::render('gate.index')  -->

@endsection

@section('content')

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nhập danh sách viên chức - NLĐ</h5>
            <form action="{{ route('excel.import') }}" method="post" enctype="multipart/form-data">
            @csrf 
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-1 col-form-label">File Upload:</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="file" name="file" id="formFile">
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection