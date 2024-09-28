@section('title','Danh sách log')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH LOG</h1>

   {{ Breadcrumbs::render('log.index') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
      <div class="col-lg-12">
         <div class="card pt-3">
            <div class="card-body table-responsive">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Log name</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Sự kiện</th>
                        <th scope="col">Người tạo</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Thuộc tính</th>
                        <th scope="col">Browsers</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                     $id = 1;
                     @endphp
                    @foreach ($data as $key => $log)
                    <tr>
                     @php
                     $json = json_decode($log->properties, true);
                     @endphp
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $log->log_name }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->event }}</td>
                        <td>{{ @$log->user->last_name }} {{ @$log->user->first_name }}</td>
                        <td>{{ $log->created_at }}</td>
                        <td>
                           @foreach(@$json['attributes'] as $k1 => $item1)
                              <div class="d-flex mb-1">
                                 <span class="badge bg-primary">{{$k1}}: Dữ liệu đã thay đổi là: {{$item1}}</span>
                                 <span class="badge bg-danger ms-1">{{$k1}}: Dữ liệu trước: {{ @$json['old'][$k1] }}</span>
                              </div>
                           @endforeach
                        </td>
                        <td class="text-danger">{{ $log->browsers }}</td>
                    </tr>
                    @php
                    $id++;
                    @endphp
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
