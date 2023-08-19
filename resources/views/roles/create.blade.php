@section('title','Tạo role')
@extends('layouts.template')

@section('breadcrumb')

   <h1>TẠO ROLE</h1>

   {{ Breadcrumbs::render('roles.create') }}
   
@endsection

@section('content')

<section class="section">
   <div class="row">
    <div class="col-lg-6">
        <div class="card pt-3">
        <div class="card-body">
            <!-- Vertical Form -->
            <form class="row g-3">
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Tên Role:</label>
                    <input type="text" class="form-control" id="inputNanme4">
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                        <!-- List group with Links and buttons -->
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action active" aria-current="true">Danh sách Permission:</div>
                            @foreach($permission as $value)
                            <div class="list-group-item list-group-item-action">
                                <div class="form-check">
                                    <input class="form-check-input" value="{{ $value->id }}" type="checkbox" id="gridCheck{{ $value->id }}" checked="">
                                    <label class="form-check-label" for="gridCheck{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div><!-- End List group with Links and buttons -->
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form><!-- Vertical Form -->
        </div>
        </div>
    </div>
   </div>
</section>
@endsection
