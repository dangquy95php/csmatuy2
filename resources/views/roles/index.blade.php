@section('title','Danh sách roles')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH ROLES</h1>

   {{ Breadcrumbs::render('roles.list') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
      <div class="col-lg-8">
         <div class="card">
            <div class="card-header">Roles
            @can('role-create')
                <span class="float-right">
                    <a class="btn btn-primary btn-sm" href="{{route('roles.create')}}">Thêm</a>
                </span>
            @endcan
            </div>
            <div class="card-body table-responsive">
               <!-- Table with stripped rows -->
               <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Ngày tạo</th>
                    @canany(['role-edit', 'role-delete'])
                    <th scope="col">
                        Hành động
                    </th>
                    @endcanany
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $role)
                    <tr>                        <th scope="row">{{$key + 1}}</th>
                        <td>{{ $role->name }}</td>
                        <td>{{ date('d-m-Y', strtotime($role->created_at)) }}</td>
                        <td>
                        @can('role-edit')
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-success  btn-sm">Sửa</a>
                        @endcan
                        @can('role-delete')
                            <a href="{{ route('roles.destroy', $role->id) }}" onclick="return confirm('Bạn có muốn xóa role {{ $role->name }} không?')" class="btn btn-danger btn-sm">Xóa</a>
                        @endcan
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
