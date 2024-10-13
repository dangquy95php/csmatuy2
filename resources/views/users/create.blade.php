@section('title','Tạo cán bộ')
@extends('layouts.template')

@section('breadcrumb')

   <h1>TẠO CÁN BỘ</h1>

   {{ Breadcrumbs::render('user.create') }}
   
@endsection

@section('content')

<section class="section">
   <div class="row">
    <div class="col-lg-4">
        <div class="card pt-3">
        <div class="card-body">
            <!-- Vertical Form -->
            <form class="row g-3" method="POST">
            @csrf
                <div class="col-12">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Tên cán bộ:</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            @include('_partials.alert', ['field' => 'name'])
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Username:</label>
                        <div class="col-sm-9">
                            <input type="text" name="username" value="{{old('username')}}" class="form-control">
                            @include('_partials.alert', ['field' => 'username'])
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Trạng thái:</label>
                        <div class="col-sm-6">
                            <select class="form-select" name="status" aria-label="Default select example">
                                <option value="0" @if(0==old('status')) selected @endif>Chưa kích hoạt</option>
                                <option value="1" @if(1==old('status')) selected @endif>Kích hoạt</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="text" name="email" value="{{old('email')}}" class="form-control">
                            @include('_partials.alert', ['field' => 'email'])
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Mật khẩu:</label>
                        <div class="col-sm-9 field-icon-group">
                            <input id="password-field" type="password" class="form-control" name="password" value="">
                            <span toggle="#password-field" class="toggle-password field-icon bi bi-eye"></span>
                            @include('_partials.alert', ['field' => 'password'])
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Quyền cán bộ:</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="roles" aria-label="Default select example">
                                <option value="">Vui lòng chọn quyền cho cán bộ</option>
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $role }}" @if($role==old('roles')) selected @endif>{{ $role }}</option>
                                @endforeach
                            </select>
                            @include('_partials.alert', ['field' => 'roles'])
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Loại tài khoản:</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="level" aria-label="Default select example">
                                <option value="">Vui lòng chọn loại tài khoản</option>
                                @foreach (App\Models\User::TYPE_ACCOUNT as $key => $account)
                                    <option value="{{ $key }}" >{{ $account }}</option>
                                @endforeach
                            </select>
                            @include('_partials.alert', ['field' => 'level'])
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Khu/Phòng:</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="team_id" aria-label="Default select example">
                                <option value="" selected="">Vui lòng chọn phòng/khu</option>
                                @foreach ($teams as $key => $team)
                                    <option @if($team->id == old('team_id')) selected @endif value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            @include('_partials.alert', ['field' => 'team_id'])
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Tạo mới</button>
                </div>
            </form><!-- Vertical Form -->
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