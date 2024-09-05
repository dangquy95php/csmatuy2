@section('title','Danh sách ngoài đơn vị')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH ĐƠN VỊ NGOÀI ĐƠN VỊ</h1>

   {{ Breadcrumbs::render('department.index') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
      <div class="col-lg-5">
            <div class="card">
                <div class="card-body pt-2">
                    <!-- <h5 class="card-title">Table with hoverable rows</h5> -->
                   
                    <!-- Table with hoverable rows -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên đơn vị</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">
                                    <span class="float-right">
                                        <a class="btn btn-primary btn-sm" href="{{route('department.create')}}">Thêm</a>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $department)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{ $department->name }}</td>
                                <td>{{ date('d-m-Y', strtotime($department->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('department.edit', $department->id) }}" class="btn btn-success btn-sm">Sửa</a>
                                    <a href="{{ route('department.destroy', $department->id) }}" onclick="return confirm('Bạn có muốn xóa role {{ $department->name }} không?')" class="btn btn-danger btn-sm">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with hoverable rows -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection