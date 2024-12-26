<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('admin_library/assets/img/favicon.png')}}" rel="icon">
    <link href="{{ asset('admin_library/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('admin_library/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link href="{{ asset('admin_library/assets/css/toastr.min.css') }}" rel="stylesheet" type="text/css" >

    <!-- Template Main CSS File -->
    <link href="{{ asset('admin_library/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
    @stack('styles')
</head>

<body>

    <main>
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
                                    <h5>Câu hỏi số <b class="text-danger" id="question_number">1</b> trên 21</h5>

                                    <form class="tab-content" method="POST" id="myTabContent">
                                        @php
                                        $questionId = 1;
                                        $shuffleData = [];
                                        @endphp
                                        @foreach($data as $k => $item)
                                        <div class="tab-pane fade" id="home{{$questionId}}" role="tabpanel" aria-labelledby="home{{$questionId}}-tab">
                                            <p style="text-align: justify;">Câu {{++$k}}: <span class="title" id="{{ $item->question_id }}">{{ $item->question_name }}</span></p>
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
                                                                    <span class="pe-2">A.</span><span class="answer">{{ $el }}</span>
                                                                @elseif($key == 1)
                                                                    <span class="pe-2">B.</span><span class="answer">{{ $el }}</span>
                                                                @elseif($key == 2)
                                                                    <span class="pe-2">C.</span><span class="answer">{{ $el }}</span>
                                                                @elseif($key == 3)
                                                                    <span class="pe-2">D.</span><span class="answer">{{ $el }}</span>
                                                                @endif
                                                            </button>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="mb-2" onClick=clickDapAn(this)>
                                                        <button type="button" class="btn btn-outline-dark text-start">
                                                            <span class="pe-2">A.</span><span class="answer">{{ $item->a }}</span>
                                                        </button>
                                                    </li>
                                                    <li class="mb-2" onClick=clickDapAn(this)>
                                                        <button type="button" class="btn btn-outline-dark text-start">
                                                            <span class="pe-2">B.</span><span class="answer">{{ $item->b }}</span>
                                                        </button>
                                                    </li>
                                                    <li class="mb-2" onClick=clickDapAn(this)>
                                                        <button type="button" class="btn btn-outline-dark text-start">
                                                            <span class="pe-2">C.</span><span class="answer">{{ $item->c }}</span>
                                                        </button>
                                                    </li>
                                                    <li class="" onClick=clickDapAn(this)>
                                                        <button type="button" class="btn btn-outline-dark text-start">
                                                            <span class="pe-2">D.</span><span class="answer">{{ $item->d }}</span>
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

                                        <div class="tab-pane fade mt-5" id="forecast" role="tabpanel" aria-labelledby="forecast-tab">
                                            <p class="mb-1" style="text-align: justify;">Câu 21: <span class="title" id="21">Theo bạn nghĩ có bao nhiều người trả lời đúng {{count($data)}} câu hỏi?</span></p>
                                            <div class="is-active">
                                                <input id="forecast_input" type="number" min="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" max="200" name="forecast" class="form-control answer" style="max-width:200px;">
                                            </div>
                                        </div>
                                        @csrf
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

                                        <li class="mb-2" onClick=clickQuestion(this) id="forecast-tab" data-bs-toggle="tab" data-bs-target="#forecast" type="button" role="tab" aria-controls="forecast" aria-selected="true" >
                                            <button type="button" class="btn btn-outline-dark me-1">21</button>
                                        </li>
                                    </ul>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" onClick="clickPrev()" class="btn btn-dark me-1">Trước</button>
                                        <button type="button" onClick="clickNext()" class="btn btn-dark">Sau</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

     <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
        &copy; Copyright <strong><span>Cơ sở cn ma túy số 2</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Thiết kể bởi <a href="">Cơ sở cn ma túy số 2</a>
        </div>
    </footer><!-- End Footer -->

      <!-- Vendor JS Files -->
    <script src="{{asset('admin_library/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('admin_library/assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('admin_library/assets/js/main.js')}}"></script>
    <script src="{{asset('admin_library/assets/js/custom-sort.js')}}"></script>
    <!-- Jquery Slim JS -->
    <script src="{{ asset('admin_library/assets/js/jquery.min.js')}} "></script>

    <script src="{{ asset('admin_library/assets/js/jquery-ui.min.js')}} "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>                       
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <svg id="SvgjsSvg1145" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1146"></defs><polyline id="SvgjsPolyline1147" points="0,0"></polyline><path id="SvgjsPath1148" d="M-1 270.2L-1 270.2C-1 270.2 176.9170673076923 270.2 176.9170673076923 270.2C176.9170673076923 270.2 294.86177884615387 270.2 294.86177884615387 270.2C294.86177884615387 270.2 412.80649038461536 270.2 412.80649038461536 270.2C412.80649038461536 270.2 530.7512019230769 270.2 530.7512019230769 270.2C530.7512019230769 270.2 648.6959134615385 270.2 648.6959134615385 270.2C648.6959134615385 270.2 766.640625 270.2 766.640625 270.2C766.640625 270.2 766.640625 270.2 766.640625 270.2 "></path></svg>

    <script src="{{ asset('admin_library/assets/js/toastr.min.js')}} "></script>
    <script src="{{ asset('js/select2.min.js')}}"></script>

    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/moment-with-locales.js') }}"></script>
    <script src="{{ asset('js/moment-timezone.js') }}"></script>

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
                    let id_question = $(this).find('.title').attr('id');

                    let answer = '';
                    if ($(this).find('.is-active').find('.answer').length > 0) {
                        if ($(this).find('.is-active').find('.answer').val() == undefined ||
                            $(this).find('.is-active').find('.answer').val() =='') {
                            answer = $(this).find('.is-active').find('.answer').text();
                        } else {
                            answer = $(this).find('.is-active').find('.answer').val();
                        }
                    }
                    
                    $("#myTabContent").append(`<input type="hidden" name="data[]" value="${question}@--@${answer}@--@${id_question}"/>`);
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
                        let id_question = $(this).find('.title').attr('id');

                        if ($(this).find('.is-active').find('.answer').val()) {
                            var answer = $(this).find('.is-active').find('.answer').val();
                        } else {
                            var answer = $(this).find('.is-active').find('.answer').text();
                        }
                        $("#myTabContent").append(`<input type="hidden" name="data[]" value="${question}@--@${answer}@--@${id_question}"/>`);
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
            let MAX_QUESTION = 21;
            let active = $(".is-question").find('.is-active');
            if (active.length > 0) {
                let id = $(active[0]).text().trim();
                if (id < MAX_QUESTION) {
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
            let id = $(that).text().trim();
            $("#question_number").text(id);
            $(that).addClass('is-active');
        }

        $('#forecast_input').change(function() {
            if ($(this).val()) {
                $("#forecast-tab").addClass('is-active1');
            } else {
                $("#forecast-tab").removeClass('is-active1');
            }
        });

        $(document).ready(function() {
            $("#sidebar").css('display', 'none');
            $("#main").css('margin-left', 0);
            var fiveMinutes = <?php echo $seconds; ?>,
            display = document.querySelector('#timer');
            startTimer(fiveMinutes, display);

            $("#myTab > li:first button").trigger('click');
        });
    </script>
    </script>
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
    {!! Toastr::message() !!}
</body>

</html>