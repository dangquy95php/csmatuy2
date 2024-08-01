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
                        <th scope="col">Subject type</th>
                        <th scope="col">Sự kiện</th>
                        <th scope="col">Subject ID</th>
                        <th scope="col">Causer type</th>
                        <th scope="col">Người tạo</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Thuộc tính</th>
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
                        <td>{{ $log->subject_type }}</td>
                        <td>{{ $log->event }}</td>
                        <td>{{ $log->subject_id }}</td>
                        <td>{{ $log->causer_type }}</td>
                        <td>{{ @$log->user->name }}</td>
                        <td>{{ $log->created_at }}</td>
                        <td>
                           <span class="badge bg-primary"><?php
                           print_r(@$json['attributes']);
                           ?></span>
                           <span class="badge bg-danger"><?php
                           print_r(@$json['old']);
                           ?></span>
                        </td>
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