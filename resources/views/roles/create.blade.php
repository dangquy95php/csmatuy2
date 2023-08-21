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
            <form class="row g-3" method="POST">
            @csrf
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Tên Role:</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="inputNanme4">
                    @include('_partials.alert', ['field' => 'name'])
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Template:</label>
                    <input type="text" name="html" value="{{old('html')}}" class="form-control" id="inputNanme4">
                </div>
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body p-0">
                            <!-- List group with Links and buttons -->
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action active" aria-current="true">Danh sách Permission:</div>
                                @foreach($permission as $value)
                                <div class="list-group-item list-group-item-action">
                                    <div class="form-check">
                                        <input {{ old('permission') && in_array($value->id, old('permission'))? 'checked' : '' }} class="form-check-input" name="permission[]" value="{{ $value->id }}" type="checkbox" id="gridCheck{{ $value->id }}">
                                        <label class="form-check-label" for="gridCheck{{ $value->id }}">
                                            {{ $value->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div><!-- End List group with Links and buttons -->
                            @include('_partials.alert', ['field' => 'permission'])
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Tạo mới</button>
                </div>
            </form><!-- Vertical Form -->
        </div>
        </div>
    </div>
   </div>
</section>
@endsection
