@section('title','Tạo Email')
@extends('layouts.template')

@section('breadcrumb')

   <h1>GỬI EMAIL</h1>

   {{ Breadcrumbs::render('email.create') }}

@endsection


@section('content')

<section class="section">
    <div class="container">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">THƯ MỚI</h5>
                    <form action="" method="post" enctype="multipart/form-data">
                    @csrf <!-- {{ csrf_field() }} -->
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Người nhận:</label>
                            <select name="auth[]" class="title form-select mb-2" aria-label="Tiêu đề"></select>
                            @include('_partials.alert', ['field' => 'auth'])
                        </div>
                        
                        <div class="col-12 mt-3">
                            <label for="inputNanme5" class="form-label">Tiêu đề:</label>
                            <input type="text" name="title" class="form-control" id="floatingName" placeholder="" value="{{old('title')}}">
                            @include('_partials.alert', ['field' => 'title'])
                        </div>
                        <div class="col-3 mt-3">
                            <input class="form-control my-3" accept=".rar, application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*" type="file" name="file[]" id="formFile" multiple>
                            @include('_partials.alert', ['field' => 'file'])
                        </div>
                        <div class="col-12 mt-3">
                            <label for="inputNanme5" class="form-label">Nội dung:</label>
                            <textarea class="form-control" name="content" style="height: 100px">{!! old('content', '') !!}</textarea>
                            @include('_partials.alert', ['field' => 'content'])
                        </div>
                        
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-primary text-center">Đăng tin <i class="bi bi-chevron-double-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $(".title").select2({
            tags: true,
            multiple:true,
            data: <?php echo json_encode($datas); ?>,
            maximumSelectionLength: 20,
            language: {
                maximumSelected: function (e) {
                    return "Bạn chỉ chọn tối đa được " + e.maximum + " thẻ";
                }
            },
        });
    });
</script>
@endpush