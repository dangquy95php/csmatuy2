@section('title','Danh sách các lỗi')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH LỖI</h1>

    {{Breadcrumbs::render('system-error.index') }}
@endsection

@section('content')

<section class="section">
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tên lỗi</th>
            <th scope="col">Tập tin</th>
            <th scope="col">Dòng lỗi</th>
            <th scope="col">Mã lỗi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($datas as $key => $item)
          <tr>
            <th scope="row">{{ ++$key }}</th>
            <td>{{ $item->message }}</td>
            <td>{{ $item->file }}</td>
            <td>{{ $item->line }}</td>
            <td>{{ $item->code }}</td>
          </tr>
          @endforeach
        </tbody>
    </table>
    {!! $datas->links('_partials.pagination') !!}
</section>
@endsection
