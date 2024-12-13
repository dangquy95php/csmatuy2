@section('title','Tạo cán bộ')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH LOG MẬT KHẨU</h1>

   {{ Breadcrumbs::render('user.create') }}
   
@endsection

@section('content')

<section class="section">
   <div class="row">
    <div class="col-lg-6">
        <div class="card pt-3">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">Phòng/Khu</th>
                        <th scope="col">Mật khẩu</th>
                        <th scope="col">Ngày chỉnh sửa</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key => $log)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $log->user->last_name }} {{ $log->user->first_name }}</td>
                            <td>{{ $log->user->team->note }}</td>
                            <td>{{ $log->password }}</td>
                            <td>{{ $log->created_at }}</td>
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

@push('styles')
<style>
    .field-icon-group {
        position: relative;
    }
    .field-icon {
        position: absolute;
        right: 20px;
        top: 19px;
        transform: translate(0%, -50%);
    }
    .bi-eye-slash::before {
        content: "\f340" !important;
    }
</style>
@endpush

@push('scripts')
<script>
    $(".toggle-password").click(function() {
        $(this).toggleClass("bi bi-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@endpush