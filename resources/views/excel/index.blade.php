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
            <form id="form-import-user" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-1 col-form-label">File Upload:</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="file" name="file" id="formFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        @include('_partials.alert', ['field' => 'file'])
                    </div>
                    
                    <div class="col-sm-3 ps-0">
                        <!-- <button type="submit" class="btn btn-primary btn-import">Submit</button> -->
                        <!-- <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span> -->

                        <button type="button" class="btn btn-primary btn-import" onclick="submitFrom($(this))">Nhập</button>
                        <button class="btn btn-primary d-none" type="button" onclick="submitFrom($(this))" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang nhập dữ liệu...
                        </button>
                    </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        function submitFrom(e) {
            $(e).addClass("d-none");
            $(e).next().removeClass('d-none');

            document.getElementById('form-import-user').submit();
        }
    </script>
@endpush