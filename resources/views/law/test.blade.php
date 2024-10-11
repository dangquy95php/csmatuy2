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
                            <button type="submit" class="btn btn-success">Nộp bài</button>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-8">
                            <h5>Câu hỏi số <b class="text-danger">1</b> trên 20</h5>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <p>Câu 1: Các hành vi tham nhũng trong khu vực ngoài nhà nước do người có chức vụ, quyền hạn trong doanh nghiệp, tổ chức khu vực ngoài nhà nước thực hiện bao gồm:</p>

                                    <div class="mt-5">
                                        <ul class="list-unstyled is-anwser">
                                            <li class="mb-2" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark">
                                                    <span class="pe-2">A.</span>Tham ô tài sản
                                                </button>
                                                <input type="button" hidden value="">
                                            </li>
                                            <li class="mb-2" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark">
                                                    <span class="pe-2">B.</span>Nhận hối lộ
                                                    </button>
                                                <input type="button" hidden value="">
                                            </li>
                                            <li class="mb-2" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark text-start">
                                                    <span class="pe-2">C.</span>Đưa hối lộ, môi giới hối lộ để giải quyết công việc của doanh nghiệp, tổ chức mình vì vụ lợi</button>
                                                <input type="button" hidden value="">
                                            </li>
                                            <li class="" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark">
                                                <span class="pe-2">D.</span>Cả A, B, C nêu trên đều đúng</button>
                                                <input type="button" hidden value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="project-tab">
                                    <p>ssssCâu 2: Các hành vi tham nhũng trong khu vực ngoài nhà nước do người có chức vụ, quyền hạn trong doanh nghiệp, tổ chức khu vực ngoài nhà nước thực hiện bao gồm:</p>

                                    <div class="mt-5">
                                        <ul class="list-unstyled is-anwser">
                                            <li class="mb-2" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark">
                                                    <span class="pe-2">A.</span>Tham ô tài sản
                                                </button>
                                                <input type="button" hidden value="">
                                            </li>
                                            <li class="mb-2" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark">
                                                    <span class="pe-2">B.</span>Nhận hối lộ
                                                    </button>
                                                <input type="button" hidden value="">
                                            </li>
                                            <li class="mb-2" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark text-start">
                                                    <span class="pe-2">C.</span>Đưa hối lộ, môi giới hối lộ để giải quyết công việc của doanh nghiệp, tổ chức mình vì vụ lợi</button>
                                                <input type="button" hidden value="">
                                            </li>
                                            <li class="" onClick=clickDapAn(this)>
                                                <button type="button" class="btn btn-outline-dark">
                                                <span class="pe-2">D.</span>Cả A, B, C nêu trên đều đúng</button>
                                                <input type="button" hidden value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- <div class="d-flex justify-content-end">
                                <div class="quiz_progress">
                                    <svg>
                                        <circle r="50"></circle>
                                        <circle id="progress" r="50" style="stroke-dasharray: 0, 9999;"></circle>
                                    </svg>
                                    <span id="progress_text">0/10</span>
                                </div>
                            </div> -->

                            <ul class="list-unstyled d-flex justify-content-end flex-wrap mt-2 border border-success p-2 border-2 is-question" id="myTabContent">
                                <li class="mb-2 is-active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true" onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">1</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this) id="project-tab" data-bs-toggle="tab" data-bs-target="#project" role="tab" aria-controls="project" aria-selected="false">
                                    <button type="button" class="btn btn-outline-dark me-1">2</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">3</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">4</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">5</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">6</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">7</button>
                                </li>
                                <li class=""  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">8</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">9</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">10</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">11</button>
                                </li>
                                <li class=""  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">12</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">13</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">14</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">15</button>
                                </li>
                                <li class=""  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">16</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">17</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">18</button>
                                </li>
                                <li class="mb-2"  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">19</button>
                                </li>
                                <li class=""  onClick=clickQuestion(this)>
                                    <button type="button" class="btn btn-outline-dark me-1">20</button>
                                </li>
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
    .is-question li.is-active button, .is-question li button:hover {
        background-color: #198754 !important;
        color: #ffffff !important;
        border-color: #198754;
    }

    .is-anwser li.is-active button  {
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
                    return;
                }
            }, 1000);
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
                }
            }
        }
        function clickDapAn(that) {
            $('.is-anwser li').each(function() {
                if ($(this).hasClass('is-active')) {
                    $(this).removeClass('is-active');
                }
            });
            $(that).addClass('is-active');
        }

        function clickQuestion(that) {
            $('.is-question li').each(function() {
                if ($(this).hasClass('is-active')) {
                    $(this).removeClass('is-active');
                }
            });
            $(that).addClass('is-active');
        }

        $(document).ready(function() {
            var fiveMinutes = 60 * 20,
            display = document.querySelector('#timer');
            startTimer(fiveMinutes, display);
        });
    </script>
@endpush