@section('title','Danh sách người dùng')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH NGƯỜI DÙNG</h1>

   {{ Breadcrumbs::render('user.list') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
      <div class="col-lg-12">
         <div class="card pt-3">
            <div class="card-body table-responsive">
               <!-- Table with stripped rows -->
               <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">
                        <a class="btn btn-primary btn-sm" href="{{route('user.create')}}">Thêm</a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            @foreach($user->user_role as $key => $value)
                                <span class="badge bg-secondary">{{$value}}</span>
                            @endforeach
                        </td>
                        <td>
                        @if( $user->status == \App\Models\User::ENABLE)
                            <span class="badge rounded-pill bg-success">Đang hoạt động</span>
                        @elseif( $user->status == \App\Models\User::DISABLE)
                            <span class="badge rounded-pill bg-danger">Không hoạt động</span>
                        @else
                            <span class="badge rounded-pill bg-warning">Chưa kích hoạt động</span>
                        @endif
                        </td>
                        <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success  btn-sm">Sửa</a>
                            <a href="" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
               <!-- End Table with stripped rows -->
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
