@section('title','Chỉnh sửa cuộc thi')
@extends('layouts.template')

@section('breadcrumb')

   <h1>CHỈNH SỬA CUỘC THI</h1>

   {{ Breadcrumbs::render('law.question.edit', $contest) }}

@endsection

@section('content')

<section class="section">
   <div class="row">
        <div class="col-lg-6">
            <form id="form" class="form-floating mb-3" method="POST">
                <button type="button" class="btn btn-primary mb-2" id="add-question" onClick="addQuestion()">Thêm câu hỏi</button>
                @if (!$isEyes)
                    <a role="button" href="{{route('contest.law.confirm', request()->route('id'))}}" target="_blank" class="ms-2"><i style="font-size: 2rem;" class="bi bi-eye d-inline-block"></i></a>
                @endif
                <div id="content">
                @foreach($data as $key => $item)
                <div class="accordion mt-2" id="question{{$item->question_id}}">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <div class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$item->question_id}}" aria-expanded="true" aria-controls="collapseOne">
                            <span class="remove" onClick="remove(this)"><i class="bi bi-x-lg"></i></span>
                                <strong class="w-100 text-center">CÂU HỎI <span class="title">{{$item->question_id}}</span>:</strong>
                            </div>
                        </h2>
                        <div id="collapseOne{{$item->question_id}}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#question{{$item->question_id}}">
                            <div class="accordion-body">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control question_name" placeholder="Nhập câu hỏi" style="height: 100px;">{{ $item->question_name }}</textarea>
                                </div>
                                <hr class="m-0 mb-2">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" id="gridRadios{{$item->question_id}}1" name="answer{{$item->question_id}}" value="A"{{ ($item->answer=="A")? "checked" : "" }}>
                                    <label class="form-check-label w-100" for="gridRadios{{$item->question_id}}1">
                                        <div class="input-group">
                                            <span class="input-group-text">A</span><textarea class="form-control answer_a" style="height:30px;">{{ $item->a }}</textarea>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" id="gridRadios{{$item->question_id}}2" name="answer{{$item->question_id}}" value="B" {{ ($item->answer=="B")? "checked" : "" }}>
                                    <label class="form-check-label w-100" for="gridRadios{{$item->question_id}}2">
                                        <div class="input-group">
                                            <span class="input-group-text">B</span><textarea class="form-control answer_b" style="height:30px;">{{ $item->b }}</textarea>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" id="gridRadios{{$item->question_id}}3" name="answer{{$item->question_id}}" value="C" {{ ($item->answer=="C")? "checked" : "" }}>
                                    <label class="form-check-label w-100" for="gridRadios{{$item->question_id}}3">
                                        <div class="input-group">
                                            <span class="input-group-text">C</span><textarea class="form-control answer_c" style="height:30px;">{{ $item->c }}</textarea>
                                        </div>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" id="gridRadios{{$item->question_id}}4" name="answer{{$item->question_id}}" value="D" {{ ($item->answer=="D")? "checked" : "" }}>
                                    <label class="form-check-label w-100" for="gridRadios{{$item->question_id}}4">
                                        <div class="input-group">
                                            <span class="input-group-text">D</span><textarea class="form-control answer_d" style="height:30px;">{{ $item->d }}</textarea>
                                        </div>
                                    </label>
                                </div>
                                <hr class="m-0">
                                <div class="row mb-3 mt-2">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input random" value="{{ $item->random }}" @if($item->random == 1) checked @endif type="checkbox" id="gridCheck{{$item->question_id}}1">
                                            <label class="form-check-label" for="gridCheck{{$item->question_id}}1">
                                                Ngẫu nhiên
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check d-flex">
                                            <label class="col-sm-4 col-form-label">Số điểm</label>
                                            <input type="number" min="1" max="20" value="{{ $item->point }}" class="form-control point">
                                        </div>
                                    </div>
                                </div>
                                <p class="text-danger message mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
                <button type="submit" class="btn btn-success mt-2" >Xong</button>
                @csrf
            </form>
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
                                <textarea class="form-control question_name" placeholder="Nhập câu hỏi" style="height: 100px;"></textarea>
                            </div>
                            <hr class="m-0 mb-2">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer${time}" id="gridRadios${time}1" value="A">
                                <label class="form-check-label w-100" for="gridRadios${time}1">
                                    <div class="input-group">
                                        <span class="input-group-text">A</span><textarea class="form-control answer_a" style="height:30px;"></textarea>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer${time}" id="gridRadios${time}2" value="B">
                                <label class="form-check-label w-100" for="gridRadios${time}2">
                                    <div class="input-group">
                                        <span class="input-group-text">B</span><textarea class="form-control answer_b" style="height:30px;"></textarea>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer${time}" id="gridRadios${time}3" value="C">
                                <label class="form-check-label w-100" for="gridRadios${time}3">
                                    <div class="input-group">
                                        <span class="input-group-text">C</span><textarea class="form-control answer_c" style="height:30px;"></textarea>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="answer${time}" id="gridRadios${time}4" value="D">
                                <label class="form-check-label w-100" for="gridRadios${time}4">
                                    <div class="input-group">
                                        <span class="input-group-text">D</span><textarea class="form-control answer_d" style="height:30px;"></textarea>
                                    </div>
                                </label>
                            </div>
                            <hr class="m-0">

                            <div class="row mb-3 mt-2">
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input random" type="checkbox" id="gridCheck${time}1">
                                        <label class="form-check-label" for="gridCheck${time}1">
                                            Ngẫu nhiên
                                        </label>
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-check d-flex">
                                        <label class="col-sm-4 col-form-label">Số điểm</label>
                                        <input type="number" min="1" max="20" value="1" class="form-control point">
                                    </div>
                                </div>
                            </div>
                            <p class="text-danger message mb-0"></p>
                        </div>
                    </div>
                </div>
            </div> 
        `;
        $("#content").append(html);
    }

    function remove(that) {
        let idQuestion = $(that).closest('.accordion').find('.title').text().trim();
        $("#content").append(`<input type="hidden" name="delete[]" value="${idQuestion}"/>`);

        $(that).closest('.accordion').remove();
    }

    $(document).ready(function() {
        $("#form").on( "submit", function( event ) {
            let data = [];
            let allowSubmit = false;
            $('.accordion').each(function(k, v) {
                let question_name = $(this).find('.question_name').val().trim();
                let question_id = $(this).find('.title').text().trim();

                let a = $(this).find('.answer_a').val().trim();
                let b = $(this).find('.answer_b').val().trim();
                let c = $(this).find('.answer_c').val().trim();
                let d = $(this).find('.answer_d').val().trim();
                let random = $(this).find("input:checkbox:checked").val();
                let point = $(this).find('.point').val().trim();
                let answer = $(this).find('input[type="radio"]:checked').val();

                if (question_name == '' || a == '' || b == '' || c == '' || d == '' || answer == undefined) {
                    $(this).find('.message').text(`Có lỗi vui lòng kiểm tra câu hỏi và đáp án và chọn câu trả lời!`);
                    allowSubmit = true;
                    event.preventDefault();
                } else {
                    $(this).find('.message').text('');
                    random = random == undefined ? 0 : 1;
                    let obj = {
                        question_name: question_name,
                        question_id: question_id,
                        a: a,
                        b: b,
                        c: c,
                        d: d,
                        random:  random,
                        point: point,
                        answer: answer
                    };

                    data.push(obj);
                }
            });
            if (!allowSubmit) {
                for (const [key, value] of Object.entries(data)) {
                    $("#content").append(`<input type="hidden" name="data[${key}][question_name]" value="${value.question_name}"/>`);
                    $("#content").append(`<input type="hidden" name="data[${key}][question_id]" value="${value.question_id}"/>`);
                    $("#content").append(`<input type="hidden" name="data[${key}][a]" value="${value.a}"/>`);
                    $("#content").append(`<input type="hidden" name="data[${key}][b]" value="${value.b}"/>`);
                    $("#content").append(`<input type="hidden" name="data[${key}][c]" value="${value.c}"/>`);
                    $("#content").append(`<input type="hidden" name="data[${key}][d]" value="${value.d}"/>`);
                    $("#content").append(`<input type="hidden" name="data[${key}][random]" value="${value.random}"/>`);
                    $("#content").append(`<input type="hidden" name="data[${key}][point]" value="${value.point}"/>`);
                    $("#content").append(`<input type="hidden" name="data[${key}][answer]" value="${value.answer}"/>`);
                }

                document.getElementById('form').submit();
            }
        });
    });
</script>
@endpush