@section('title','Danh sách phép')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH PHÉP</h1>

   {{ Breadcrumbs::render('permit.index') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
      <div class="col-lg-6">
         <div class="card pt-3">
            <div class="card-body table-responsive">
               <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Người tải ảnh</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">
                        <a href="{{ route('permit.create') }}" type="button" class="btn btn-primary btn-sm">Thêm</a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $permit)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>
                            <img data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key + 1 }}" src="{{ !file_exists('storage/permit/'.$permit->image) ? asset('storage/permit/default.jpg') : asset('storage/permit/'.$permit->image)}}" style="width:70px;" class="img-fluid img-thumbnail" alt="">
                            <div class="modal fade" id="exampleModal{{ $key + 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Người tải lên: {{ $permit->user->username }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="img-fluid w-100" src="{{ !file_exists('storage/permit/'.$permit->image) ? asset('storage/permit/default.jpg') : asset('storage/permit/'.$permit->image) }}" alt="">
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $permit->user->username }}</td>
                        <td>{{ $permit->created_at }}</td>
                        <td>
                            <a href="{{ route('permit.edit', $permit->id) }}" class="btn btn-success btn-sm">Sửa</a>
                            <a href="{{ route('permit.destroy', $permit->id) }}" onclick="return confirm('Bạn có muốn xóa {{ $permit->name }} không?')" class="btn btn-danger btn-sm">Xóa</a>
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