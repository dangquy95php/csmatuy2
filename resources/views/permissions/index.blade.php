@section('title','Danh sách permission')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH PERMISSIONS</h1>

   {{ Breadcrumbs::render('permission.list') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
      <div class="col-lg-8">
         <div class="card">
            <div class="card-header">Permission
                <span class="float-right">
                    <a class="btn btn-primary btn-sm" href="{{route('permission.create')}}">Thêm</a>
                </span>
            </div>
            <div class="card-body table-responsive">
               <!-- Table with stripped rows -->
               <table class="table table-striped small">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">
                        Hành động
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $permission)
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{ $permission->name }}</td>
                        <td>{{ date('d-m-Y', strtotime($permission->created_at)) }}</td>
                        <td>
                            <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-success  btn-sm">Sửa</a>
                            <a href="{{ route('permission.destroy', $permission->id) }}" onclick="return confirm('Bạn có muốn xóa permission {{ $permission->name }} không?')" class="btn btn-danger btn-sm">Xóa</a>
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
