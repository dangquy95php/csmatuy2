@section('title','Thi Pháp Luật')
@extends('layouts.template')

@section('breadcrumb')

   <h1>THI PHÁP LUẬT</h1>

   {{ Breadcrumbs::render('contest.law', $contest) }}

@endsection


@section('content')

<section class="section">
   <div class="row align-items-center h-100 justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body p-5">
                    <b class="text-danger" id="message"></b>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="d-flex align-middle">
                                <i class="bi bi-alarm fs-1 d-flex align-items-center"></i>
                                <div class="d-flex flex-column ps-2">
                                    <span class="">Thời gian còn lại</span>
                                    <span class="text-danger"><b id="timer"></b></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 text-end">
                            <button type="button" class="btn btn-success" onClick="submit()">Nộp bài</button>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-8">
                            <h5>Câu hỏi số <b class="text-danger" id="question_number">1</b> trên 20</h5>

                            <form class="tab-content" method="POST" id="myTabContent">
                                @php
                                $questionId = 1;
                                $shuffleData = [];
                                @endphp
                                @foreach($data as $k => $item)
                                <div class="tab-pane fade" id="home{{$questionId}}" role="tabpanel" aria-labelledby="home{{$questionId}}-tab">
                                    <p style="text-align: justify;">Câu {{++$k}}: <span class="title">{{$item->question_name}}</span></p>
                                    @php
                                    if ($item->random == 1) {
                                        array_push($shuffleData, $item->a);
                                        array_push($shuffleData, $item->b);
                                        array_push($shuffleData, $item->c);
                                        array_push($shuffleData, $item->d);
                                    }
                                    @endphp
                                    <div class="mt-3">
                                        <ul class="list-unstyled is-anwser">
                                        @if($shuffleData)
                                            @foreach(collect($shuffleData)->shuffle() as $key => $el)
                                                <li class="mb-2" onClick=clickDapAn(this)>
                                                    <button type="button" class="btn btn-outline-dark text-start">
                                                        @if($key == 0)
                                                            <span class="pe-2">A.</span><span class="answer">{{$el}}</span>
                                                        @elseif($key == 1)
                                                            <span class="pe-2">B.</span><span class="answer">{{$el}}</span>
                                                        @elseif($key == 2)
                                                            <span class="pe-2">C.</span><span class="answer">{{$el}}</span>
                                                        @elseif($key == 3)
                                                            <span class="pe-2">D.</span><span class="answer">{{$el}}</span>
                                                        @endif
                                                    </button>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="mb-2" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark text-start">
                                                    <span class="pe-2">A.</span><span class="answer">{{$item->a}}</span>
                                                </button>
                                            </li>
                                            <li class="mb-2" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark text-start">
                                                    <span class="pe-2">B.</span><span class="answer">{{$item->b}}</span>
                                                </button>
                                            </li>
                                            <li class="mb-2" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark text-start">
                                                    <span class="pe-2">C.</span><span class="answer">{{$item->c}}</span>
                                                </button>
                                            </li>
                                            <li class="" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark text-start">
                                                    <span class="pe-2">D.</span><span class="answer">{{$item->d}}</span>
                                                </button>
                                            </li>
                                        @endif
                                        </ul>
                                    </div>
                                </div>
                                @php
                                $questionId++;
                                $shuffleData = [];
                                @endphp
                                @endforeach

                                @csrf
                                <!-- <div class="mt-3" id="binhcon-tab" role="tabpanel" aria-labelledby="binhcon-tab">
                                    <p style="text-align: justify;">Câu 21: <span class="title">Theo bạn nghĩ có bao nhiều người trả lời đúng {{count($data)}} câu hỏi?</span></p>
                                    <input type="text" class="form-control mt-2" name="binhchon" placeholder="Nhập số dự đoán">
                                </div> -->
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <ul class="list-unstyled d-flex justify-content-end flex-wrap mt-2 border border-success p-2 border-2 is-question" id="myTab" role="tablist">
                                @php
                                $questionId = 1;
                                @endphp
                                @foreach($data as $k => $item)
                                <li class="mb-2 " onClick=clickQuestion(this) id="home{{$questionId}}-tab" data-bs-toggle="tab" data-bs-target="#home{{$questionId}}" type="button" role="tab" aria-controls="home{{$questionId}}" aria-selected="true" >
                                    <button type="button" class="btn btn-outline-dark me-1">{{$questionId}}</button>
                                </li>
                                @php
                                $questionId ++;
                                @endphp
                                @endforeach

                                <!-- <li class="mb-2 " onClick=clickQuestion(this) id="binhcon-tab" data-bs-toggle="tab" data-bs-target="#binhcon" type="button" role="tab" aria-controls="home{{$questionId}}" aria-selected="true" >
                                    <button type="button" class="btn btn-outline-dark me-1">21</button>
                                </li> -->
                            </ul>
                            <div class="d-flex justify-content-end">
                                <button type="button" onClick="clickPrev()" class="btn btn-success me-1">Trước</button>
                                <button type="button" onClick="clickNext()" class="btn btn-success">Sau</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@push('styles')
<style>
    .is-question li.is-active button, .is-question li button:hover,
    .is-question li.is-active1 button {
        background-color: #198754 !important;
        color: #ffffff !important;
        border-color: #198754;
    }

    .is-anwser li.is-active button {
        background-color: #212529;
        color: white;
    }
    /* .is-anwser  {
        background-color: initial !important;
        color: #212529 !important;
    } */
    .quiz_progress {
        display: flex;
        position: relative;
        width: 115px;
        height: 115px;
    }
    .quiz_progress svg {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-90deg);
        pointer-events: none;
    }
    .quiz_progress svg circle {
        transform: translate(50%, 50%);
        fill: none;
        stroke: #ddd; 
        stroke-width: 10px;
        stroke-linecap: round;
    }
    #progress {
        stroke: #198754;
        stroke-dasharray: 250 9999;
        transition: 0.5s;
    }
    #progress_text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 2rem;
        font-weight: bold;
        color: #273d30;
    }
</style>
@endpush

@push('scripts')
    <script>
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    var countdownElement = document.getElementById("timer");
                    countdownElement.innerHTML = "Hết thời gian!";
                    // timer = duration;
                    submit(true);
                    return;
                }
            }, 1000);
        }

        function submit(timeOut = false) {
            if(timeOut) {
                $("#myTabContent .tab-pane").each(function(k) {
                    let question = $(this).find('.title').text();
                    let answer = '';
                    if ($(this).find('.is-active').find('.answer').length > 0) {
                        answer = $(this).find('.is-active').find('.answer').text();
                    }
                    
                    $("#myTabContent").append(`<input type="hidden" name="data[]" value="${question}@--@${answer}"/>`);
                    document.getElementById("myTabContent").submit();
                });
                return false;
            }

            let flag = false;

            $("#message").text('');
            $("#myTab li").each(function(k) {
                if (!$(this).hasClass('is-active1')) {
                    $("#message").text(`Có lỗi: câu hỏi số ${++k} chưa trả lời`);
                    flag = true;
                    return false;
                }
            });       
            
            if (flag == false) {
                if (confirm('Bạn có chắc chắn muốn nộp bài không?')) {
                    $("#myTabContent .tab-pane").each(function(k) {
                        let question = $(this).find('.title').text();
                        let answer = $(this).find('.is-active').find('.answer').text();
                        
                        $("#myTabContent").append(`<input type="hidden" name="data[]" value="${question}@--@${answer}"/>`);
                        document.getElementById("myTabContent").submit();
                    });
                }
            }
        }

        function clickPrev() {
            let active = $(".is-question").find('.is-active');
            if (active.length > 0) {
                let id = $(active[0]).text().trim();
                if (id > 1) {
                    $('.is-question li').each(function() {
                        if ($(this).hasClass('is-active')) {
                            $(this).removeClass('is-active');
                        }
                    });
                    $(active[0]).prev().addClass('is-active');
                    $(active[0]).prev().trigger('click');
                }
            }
        }
        function clickNext() {
            let active = $(".is-question").find('.is-active');
            if (active.length > 0) {
                let id = $(active[0]).text().trim();
                if (id < 20) {
                    $('.is-question li').each(function() {
                        if ($(this).hasClass('is-active')) {
                            $(this).removeClass('is-active');
                        }
                    });
                    $(active[0]).next().addClass('is-active');
                    $(active[0]).next().trigger('click');
                }
            }
        }
        function clickDapAn(that) {
            $(that).closest('.is-anwser').find('li').each(function() {
                if ($(this).hasClass('is-active')) {
                    $(this).removeClass('is-active');
                }
            });

            $(that).addClass('is-active');
            let id = $(that).closest('.tab-pane').attr('id');

            $("#"+ id + "-tab").addClass('is-active1');
        }

        function clickQuestion(that) {            
            $('.is-question li').each(function() {
                if ($(this).hasClass('is-active')) {
                    $(this).removeClass('is-active');
                }
            });
            let id = $(that).text()
            $("#question_number").text(id);
            $(that).addClass('is-active');
        }

        $(document).ready(function() {
            $("#sidebar").css('display', 'none');
            $("#main").css('margin-left', 0);
            var fiveMinutes = 60 * <?php echo $minutes; ?>,
            display = document.querySelector('#timer');
            startTimer(fiveMinutes, display);

            $("#myTab > li:first button").trigger('click');
        });
    </script>
@endpush