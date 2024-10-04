@section('title','Chỉnh sửa người dùng')
@extends('layouts.template')

@section('breadcrumb')

   <h1>CHỈNH SỬA NGƯỜI DÙNG</h1>

   {{ Breadcrumbs::render('user.edit', $user) }}

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
                    <label for="inputNanme4" class="form-label">Họ:</label>
                    <input type="text" name="first_name" placeholder="Nhập họ" value="{{ $user->first_name }}" class="form-control" id="inputNanme4">
                    @include('_partials.alert', ['field' => 'first_name'])
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Tên:</label>
                    <input type="text" name="last_name" placeholder="Nhập tên" value="{{ $user->last_name }}" class="form-control" id="inputNanme1">
                    @include('_partials.alert', ['field' => 'last_name'])
                </div>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Email:</label>
                    <input type="email" name="email" placeholder="Nhập email" value="{{ $user->email }}" class="form-control" id="inputEmail4">
                    @include('_partials.alert', ['field' => 'email'])
                </div>
                <div class="col-12">
                    <label for="inputEmail1" class="form-label">Username:</label>
                    <input type="text" name="username" readonly value="{{ $user->username }}" placeholder="Nhập username" class="form-control" id="inputEmail1">
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
                            <option {{ $key == $user->status ? 'selected' : '' }}  value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-10">
                    <label class="form-label">Role:</label>
                    <select class="form-select" name="roles[]" multiple="" aria-label="multiple select example">
                        @foreach($roles as $key => $value)
                            @php
                                $flag = false;
                            @endphp
                            @foreach ($userRole as $roleUser)
                                @if($value == $roleUser)
                                    <option selected value="{{$key}}">{{$value}}</option>
                                    @php
                                        $flag = true;
                                    @endphp
                                @endif
                            @endforeach

                            @if(!$flag)
                                <option value="{{$key}}">{{$value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <img class="img-fluid w-100" src="{{ !file_exists('storage/profile/'.$user->image) || empty($user->image) ? asset('storage/profile/default.jpg') : asset('storage/profile/'.$user->image) }}" alt="">
                </div>
              
                <div class="text-center mt-2">
                    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                    <!-- <button type="reset" class="btn btn-secondary">Reset</button> -->
                </div>
            </form><!-- Vertical Form -->
        </div>
    </div>
</div>
@endsection