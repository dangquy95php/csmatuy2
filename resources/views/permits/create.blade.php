@section('title','Tải phép phòng/khu')
@extends('layouts.template')

@section('breadcrumb')

   <h1>TẠO PHÉP</h1>

   {{ Breadcrumbs::render('permit.create') }}
   
@endsection

@section('content')

<section class="section">
   <div class="row">
    <div class="col-lg-4">
        <div class="card pt-3">
        <div class="card-body">
            <!-- Vertical Form -->
            <form class="row g-3" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Tải hình ảnh phép:</label>
                    <input name="image" accept="image/png, image/jpeg" class="form-control" type="file" id="formFile">
                    @include('_partials.alert', ['field' => 'image'])
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
        </div>
        </div>
    </div>
   </div>
</section>
@endsection
