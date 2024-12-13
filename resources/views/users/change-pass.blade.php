@section('title','Thay đổi mật khẩu')
@extends('layouts.template')

@section('breadcrumb')

   <h1>THAY ĐỔI MẬT KHẨU</h1>

   {{ Breadcrumbs::render('user.change-pass') }}
   
@endsection

@section('content')

<section class="section">
   <div class="row">
    <div class="col-lg-4">
        <form class="row g-3" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <!-- Vertical Form -->
                    <div class="col-12 mt-4">
                        <label for="inputPassword4" class="form-label">Nhập mật khẩu mới:</label>
                        <input type="password" placeholder="Nhập mật khẩu mới" name="new_password" class="form-control" id="inputPassword4">
                        @include('_partials.alert', ['field' => 'password'])
                    </div>
                    <div class="col-12 mt-3">
                        <label for="inputPassword10" class="form-label">Nhập lại mật khẩu:</label>
                        <input type="password" placeholder="Nhập lại mật khẩu" name="password_confirmation" class="form-control" id="inputPassword10">
                        @include('_partials.alert', ['field' => 'password_confirmation'])
                    </div>
                    
                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary">Xong</button>
                    </div>
                </div>
            </div>
        </form><!-- Vertical Form -->
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