@section('title','Cập nhật phòng/khu')
@extends('layouts.template')

@section('breadcrumb')

   <h1>CẬP NHẬT Phòng/Khu</h1>

   {{ Breadcrumbs::render('team.edit', $team) }}
   
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
                    <label for="inputNanme4" class="form-label">Tên Phòng/Khu:</label>
                    <input type="text" name="name" value="{{old('name', $team->name)}}" class="form-control" id="inputNanme4">
                    @include('_partials.alert', ['field' => 'name'])
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                </div>
            </form><!-- Vertical Form -->
        </div>
        </div>
    </div>
   </div>
</section>
@endsection
