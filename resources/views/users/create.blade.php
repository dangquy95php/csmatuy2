@section('title','Thêm người dùng')
@extends('layouts.template')

@section('breadcrumb')

   <h1>THÊM NGƯỜI DÙNG</h1>

   {{ Breadcrumbs::render('user.create') }}

@endsection

@section('content')

<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Thông tin nhân viên</h5>

            <!-- Vertical Form -->
            <form class="row g-3" method="POST">
            @csrf
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Họ tên:</label>
                    <input type="text" name="name" placeholder="Nhập họ tên" value="{{ old('name') }}" class="form-control" id="inputNanme4">
                    @include('_partials.alert', ['field' => 'name'])
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Email:</label>
                    <input type="email" name="email" placeholder="Nhập email" value="{{ old('email') }}" class="form-control" id="inputEmail4">
                    @include('_partials.alert', ['field' => 'email'])
                </div>
                <div class="col-12">
                    <label for="inputEmail1" class="form-label">Username:</label>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Nhập username" class="form-control" id="inputEmail1">
                    @include('_partials.alert', ['field' => 'username'])
                </div>
                <div class="col-12">
                    <label for="inputPassword4" class="form-label">Mật khẩu:</label>
                    <input type="password" placeholder="Nhập mật khẩu" name="password" class="form-control" id="inputPassword4">
                    @include('_partials.alert', ['field' => 'password'])
                </div>
                <div class="col-12">
                    <label for="inputPassword10" class="form-label">Nhập lại mật khẩu:</label>
                    <input type="password" placeholder="Nhập lại mật khẩu" name="password_confirmation" class="form-control" id="inputPassword10">
                    @include('_partials.alert', ['field' => 'password_confirmation'])
                </div>
                <div class="col-12">
                    <label for="inputPassword5" class="form-label">Trạng thái:</label>
                    <select id="inputState" name="status" class="form-select" name="status">
                        @foreach(\App\Models\User::INFOR_STATUS as $key => $value)
                            <option @if($key == old('status')) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Role:</label>
                    <select class="form-select" name="roles[]" multiple="" aria-label="multiple select example">
                        @foreach($roles as $key => $value)
                            <option @if (old("roles")){{ (in_array($key, old("roles")) ? "selected":"") }}@endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    @include('_partials.alert', ['field' => 'roles'])
                </div>
              
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
                </div>
            </form><!-- Vertical Form -->
        </div>
    </div>
</div>
@endsection