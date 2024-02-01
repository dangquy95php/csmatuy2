@section('title','Danh sách cán bộ vào ra cổng')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH CÁN BỘ VÀO RA CỔNG</h1>

   {{ Breadcrumbs::render('gate.index') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
      <div class="col-lg-12">
            <div class="card">
                <div class="card-body pt-2">
                    <!-- <h5 class="card-title">Table with hoverable rows</h5> -->

                    <!-- Table with hoverable rows -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên nhân viên</th>
                                <th scope="col">Số người cai nghiện</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col">Loại hình</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Brandon Jacob</td>
                                <td>Designer</td>
                                <td>28</td>
                                <td>2016-05-25</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Table with hoverable rows -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection