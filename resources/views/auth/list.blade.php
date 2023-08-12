@section('title','Danh sách người dùng')
@extends('layouts.template')

@section('breadcrumb')

   <h1>DANH SÁCH NGƯỜI DÙNG</h1>

   {{ Breadcrumbs::render('user_list') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
      <div class="col-lg-12">

      <div class="card">
            <div class="card-body">
              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Ngày cập nhật</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                    <td>28</td>
                    <td>2016-05-25</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
          </div>
      </div>
   </div>
</section>
@endsection