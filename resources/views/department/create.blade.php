@section('title','Tạo đơn vị')
@extends('layouts.template')

@section('breadcrumb')

   <h1>TẠO ĐƠN VỊ</h1>

   {{ Breadcrumbs::render('gate.create') }}
   
@endsection

@section('content')

<section class="section">
   <div class="row">
    <div class="col-lg-5">
        <div class="card pt-3">
            <div class="card-body">
                <!-- Vertical Form -->
                <form class="row g-3" method="POST">
                @csrf
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Tên đơn vị:</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="inputNanme4">
                        @include('_partials.alert', ['field' => 'name'])
                    </div>
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Ghi chú:</label>
                        <textarea class="form-control" name="note" placeholder="Vui lòng nhập ghi chú" id="floatingTextarea" style="height: 100px;"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-sm">Tạo mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   </div>
</section>
@endsection
