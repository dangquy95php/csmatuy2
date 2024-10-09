@section('title','Tạo cuộc thi')
@extends('layouts.template')

@section('breadcrumb')

   <h1>TẠO CUỘC THI</h1>

   {{ Breadcrumbs::render('contest.create') }}

@endsection

@section('content')

<section class="section">
   <div class="row">
        <div class="col-lg-6">
            <button type="button" class="btn btn-primary mb-2" id="add-question" onClick="addQuestion()">Thêm</button>

            <div class="form-floating mb-3" id="content">
                
                <!-- <div class="accordion" id="question1">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="bi bi-x-lg"></i><strong class="w-100 text-center">CÂU HỎI 1:</strong>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#question1">
                            <div class="accordion-body">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="" placeholder="Nhập câu hỏi" style="height: 100px;">Các hành vi tham nhũng trong khu vực ngoài nhà nước do người có chức vụ, quyền hạn trong doanh nghiệp, tổ chức khu vực ngoài nhà nước thực hiện bao gồm</textarea>
                                </div>
                                <hr class="m-0 mb-2">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1">
                                    <label class="form-check-label" for="gridRadios1">Tham ô tài sản</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                    <label class="form-check-label" for="gridRadios2">Nhận hối lộ</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
                                    <label class="form-check-label" for="gridRadios3">Đưa hối lộ, môi giới hối lộ để giải quyết công việc của doanh nghiệp, tổ chức mình vì vụ lợi</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="option4">
                                    <label class="form-check-label" for="gridRadios4">Cả A, B, C nêu trên đều đúng</label>
                                </div>
                                <hr class="m-0">

                                <div class="row mb-3 mt-2">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Đáp án:</label>
                                    <div class="col-sm-4">
                                        <select id="inputState" class="form-select">
                                            <option selected="">Vui lòng chọn đáp án</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                                            <label class="form-check-label" for="gridCheck1">
                                                Ngẫu nhiên
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endpush

@push('scripts')

<script>
    function addQuestion() {
        let rows = $('#content').find('.accordion').length + 1;
        const d = new Date();
        let time = d.getTime();
        
        let html = `
            <div class="accordion mt-2" id="question${time}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <div class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne${time}" aria-expanded="true" aria-controls="collapseOne">
                        <span class="remove" onClick="remove(this)"><i class="bi bi-x-lg"></i></span>
                            <strong class="w-100 text-center">CÂU HỎI <span class="title">${rows}</span>:</strong>
                        </div>
                    </h2>
                    <div id="collapseOne${time}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#question${time}">
                        <div class="accordion-body">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="" placeholder="Nhập câu hỏi" style="height: 100px;"></textarea>
                            </div>
                            <hr class="m-0 mb-2">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios${time}1" value="option1">
                                <label class="form-check-label w-100" for="gridRadios${time}1">
                                    <div class="input-group">
                                        <span class="input-group-text">A</span><textarea class="form-control" style="height:30px;"></textarea>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios${time}2" value="option2">
                                <label class="form-check-label w-100" for="gridRadios${time}2">
                                    <div class="input-group">
                                        <span class="input-group-text">B</span><textarea class="form-control" style="height:30px;"></textarea>
                                    </div>
                                </label>
                            </div>
                        <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios${time}3" value="option1">
                                <label class="form-check-label w-100" for="gridRadios${time}3">
                                    <div class="input-group">
                                        <span class="input-group-text">C</span><textarea class="form-control" style="height:30px;"></textarea>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios${time}4" value="option1">
                                <label class="form-check-label w-100" for="gridRadios${time}4">
                                    <div class="input-group">
                                        <span class="input-group-text">D</span><textarea class="form-control" style="height:30px;"></textarea>
                                    </div>
                                </label>
                            </div>
                            <hr class="m-0">

                            <div class="row mb-3 mt-2">
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck${time}1">
                                        <label class="form-check-label" for="gridCheck${time}1">
                                            Ngẫu nhiên
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        `;
        $("#content").append(html);
    }

    function remove(that) {
        $(that).closest('.accordion').remove();
        $(".accordion").each(function(k, v) {
            $(this).find('.title').text(k + 1);
        })
    }

    $(document).ready(function() {
        $("#content").sortable({
            stop: function(event, ui) {
                $(".accordion").each(function(k, v) {
                    $(this).find('.title').text(k + 1);
                })  
            }
        });
    });
</script>
@endpush