@section('title','Danh sách các khu')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH CÁC KHU</h1>

   {{ Breadcrumbs::render('team.index') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
      <div class="col-lg-6">
            <div class="card">
                <div class="card-body pt-2 table-responsive">
                    <!-- <h5 class="card-title">Table with hoverable rows</h5> -->

                    <!-- Table with hoverable rows -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên khu
                                <span class="float-right">
                                    <a class="btn btn-primary btn-sm" href="{{route('team.create')}}">Thêm</a>
                                </span>
                            </th>
                            <th scope="col">Ghi chú</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $team)
                            <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td class="text-capitalize">{{ $team->name }}</td>
                                <td class="text-capitalize">{{ $team->note }}</td>
                                <td>{{ date('d-m-Y', strtotime($team->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('team.edit', $team->id) }}" class="btn btn-success  btn-sm">Sửa</a>
                                    <a href="{{ route('team.destroy', $team->id) }}" onclick="return confirm('Bạn có muốn xóa phòng/khu {{ $team->name }} không?')" class="btn btn-danger btn-sm">Xóa</a>
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
