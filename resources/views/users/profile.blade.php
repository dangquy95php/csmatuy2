@section('title','Thông tin trang cá nhân')
@extends('layouts.template')

@section('breadcrumb')

   <h1>THÔNG TIN TRANG CÁ NHÂN</h1>

    <!-- Breadcrumbs::render('user.list') }} -->

@endsection

@section('content')

<section class="section">
    <div class="card">
        <div class="card-body pt-3">
            <div class="tab-content pt-2">
                <div class="tab-pane fade profile-edit pt-3 active show" id="profile-edit" role="tabpanel">

                    <!-- Profile Edit Form -->
                    <form class="col-md-6 g-3" method="POST"  enctype="multipart/form-data">
                    @csrf
                        <div class="row mb-3">
                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Ảnh cá nhân:</label>
                            <div class="col-md-8 col-lg-9">
                            @php
                            $image = '';
                            if(empty(Auth::user()->image)) {
                                if (@Auth::user()->user_infor->gioi_tinh == 1) {
                                    $image = 'default-male.jpg';
                                } else {
                                    $image = 'default-female.jpg';
                                }
                            } else {
                                $image = Auth::user()->image;
                            }
                            @endphp
                            <img src="{{asset('storage/profile/'.$image)}}" alt="Profile" class="w-25 img-thumbnail">
                            <div class="pt-2">
                                <span class="btn btn-primary btn-sm" title="Upload new profile image">
                                    <input name="image" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept="image/png, image/jpeg" />
                                    <i class="bi bi-upload"></i>
                                </span>
                                <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                            </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title">Thông tin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Vui lòng kiểm tra lại thông tin của bạn.<br/>
                                                <span class="text-danger">Hình đại diện bắt buộc phải tải lên.<br/></span>
                                                <span class="text-danger">Email bắt buộc phải có.<br/></span>
                                                Nếu thông tin chưa được cập nhật. Xin vui lòng hãy cập nhật.
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div><!-- End Basic Modal-->
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Họ và tên:</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="name" type="text" class="form-control" id="fullName" value="{{Auth::user()->name}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="about" class="col-md-4 col-lg-3 col-form-label">Username:</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="username" type="text" class="form-control" id="about" readonly value="{{Auth::user()->username}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="company" class="col-md-4 col-lg-3 col-form-label">Email:</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="email" type="text" class="form-control" id="company" readonly value="{{Auth::user()->email}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Cấp Quyền:</label>
                            <div class="col-md-8 col-lg-9">
                                @php
                                    if(isset(Auth::user()->roles->pluck('name')[0])) {
                                        $khu = '';
                                        foreach(Auth::user()->roles->pluck('name') as $k => $item) {
                                            $khu = $khu . $item;
                                            if ($k < count(Auth::user()->roles->pluck('name')) - 1) {
                                                $khu = $khu . ', ';
                                            }
                                        }
                                    }
                                @endphp
                                <input name="role" type="text" class="form-control" id="Job" readonly value="{{ @$khu }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Khu:</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="team" type="text" class="form-control" id="Country"
                                readonly value="{{ auth()->user()->load(['team'])->team ? auth()->user()->load(['team'])->team->name : 'Không có hình ảnh'; }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Ngày tạo:</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="country" type="text" class="form-control" id="Country" readonly value="{{Auth::user()->created_at}}">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form><!-- End Profile Edit Form -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
isHasData
<script type="text/javascript">
    var isHasData = JSON.parse("{{ $isHasData }}");
    $(document).ready(function() {
        if (isHasData) {
            $('#basicModal').modal('show');
        }
    });
</script>
@endpush