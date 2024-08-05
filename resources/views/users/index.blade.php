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
                <form class="mt-2" id="form-staff" action="" method="get">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <input name="search" type="text" value="{{request()->input('search')}}" class="form-control" id="colFormLabel" placeholder="Nhập tên nhân viên tìm kiếm">
                        </div>
                        <div class="col-sm-2 ps-0">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </form>
               <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Username</th>
                    <th scope="col" id="title-roles">Roles</th>
                    <th scope="col" id="title-team">Khu/Phòng</th>
                    <th scope="col">Email</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tạo</th>
                    @canany('user-create')
                    <th scope="col">
                        <a href="{{ route('user.create') }}" type="button" class="btn btn-primary btn-sm">Thêm</a>
                    </th>
                    @endcanany
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            @foreach($user->user_role as $k => $value)
                                <span class="badge bg-secondary">{{$value}}</span>
                            @endforeach
                        </td>
                        <td>{{ $user->team ? $user->team->name : 'Không thuộc team' }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <img data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key + 1 }}" src="{{ !file_exists('storage/profile/'.$user->image) || empty($user->image) ? asset('storage/profile/default.jpg') : asset('storage/profile/'.$user->image)}}" style="width:70px;" class="img-fluid img-thumbnail" alt="">
                            
                            <div class="modal fade" id="exampleModal{{ $key + 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $user->team ? $user->team->name : 'Không thuộc team' }}: <b>{{ $user->name }}</b></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="img-fluid w-100" src="{{ !file_exists('storage/profile/'.$user->image) || empty($user->image) ? asset('storage/profile/default.jpg') : asset('storage/profile/'.$user->image) }}" alt="">
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            @canany('user-edit')
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success  btn-sm">Sửa</a>
                            @endcanany
                            @canany('user-delete')
                            <a href="{{ route('user.destroy', $user->id) }}" onclick="return confirm('Bạn có muốn xóa {{ $user->name }} không?')" class="btn btn-danger btn-sm">Xóa</a>
                            @endcanany
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              {!! $data->links('_partials.pagination') !!}
               <!-- End Table with stripped rows -->
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('#title-team').click(function() {
        sortTable("title-team", this);
    });
    $('#title-roles').click(function() {
        sortTable("title-roles", this);
    });
});
</script>
@endpush()
