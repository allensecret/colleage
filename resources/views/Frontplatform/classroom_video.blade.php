<!DOCTYPE html>
<html lang="en">

<head>
    <title>佛陀教育網路學院</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="/img/frontplatform/logo.ico">
    <link href="https://fonts.googleapis.com/css?family=Zhi+Mang+Xing&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="{{ asset('/css/frontplatform/my_css.css') }}">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">

    <script src="/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>FontJSON = { User: "9856", DomainID: "freeUQYGDASDZTNAI", Font: ["DFXingShuStd-W5"] }</script>
    <script src='https://dfo.dynacw.com.tw/DynaJSFont/DynaFont.js'></script>
    <script src="https://kit.fontawesome.com/847b731f5e.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

    @stack('scripts')
    <script>
        $(document).ready(function () {
            $(window).scroll(function() {
                if ( $(this).scrollTop() > 500){
                    $('#gotop').fadeIn("fast");
                } else {
                    $('#gotop').stop().fadeOut("fast");
                }
            });

            $("#gotop").click(function(){
                jQuery("html,body").animate({
                    scrollTop:0
                },1000);
            });

            $('video').on('ended',function(){
                console.log('Video has ended!');
            });

            var $time = 0;
            $('video')[0].addEventListener('timeupdate',function () {
                var $juicePos = $('video')[0].currentTime / $('video')[0].duration;
                // console.log($juicePos * 100);
                $('.orange-juice').css('width',$juicePos * 100 + "%");

                {{--if($time > 1800 && $('video')[0].currentTime > 1800){--}}
                    {{--// console.log('is time');--}}
                    {{--$.post("/api/ep_done",--}}
                        {{--{--}}
                            {{--student_curricula : "{{ $curricula }}",--}}
                            {{--ep : "{{ $classroom->course_data."_".$classroom->ep }}"--}}
                        {{--},--}}
                        {{--function(data,status){--}}
                            {{--console.log(status);--}}
                        {{--}--}}
                    {{--);--}}
                {{--}--}}
                {{--$time++;--}}
            });
        });
    </script>
    @stack('style')

    <style>
        .d-flex{
            position: relative;
        }

        .c-video{
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .c-video:hover .controls{
            transform: translateY(0);
        }
        video{
            width: 100%;
        }



        .controls{
            display: flex;
            position: absolute;
            top:0;
            width: 100%;
            flex-wrap: wrap;
            z-index: 2;
            transform: translateY(-100%) translateY(5px);
            transition: all 0.2s;
        }

        .back-button{
            padding-top: 5px;
            padding-left: 15px;
        }

        .back-button a{
            text-decoration: none;
            background: none;
            border: 0;
            outline: 0;
            cursor: pointer;
            color: white;
        }

        .back-button a:hover{
            color: white;
        }
        .back-button a:before{
            content: '\f104  回課程目錄';
            font-family: FontAwesome;
            height: 30px;
            display: inline-block;
            font-size: 1rem;
            color: white;
            -webkit-font-smoothing: antialiased;
        }

        .next-button{
            padding-top: 5px;
            padding-left: 15px;
        }

        .next-button a{
            text-decoration: none;
            background: none;
            border: 0;
            outline: 0;
            cursor: pointer;
            color: white;
        }

        .next-button a:hover{
            color: white;
        }
        .next-button a:before{
            content: '下一集  \f105';
            font-family: FontAwesome;
            height: 30px;
            display: inline-block;
            font-size: 1rem;
            color: white;
            -webkit-font-smoothing: antialiased;
        }

    </style>
</head>

<body>
@include('Frontplatform.layouts.nav')

<div class="d-flex flex-row justify-content-center" style="background-color: black">
    <div class="p-2 video-container">
        <div class="c-video">
            <div class="controls">
                <div class="d-flex justify-content-between" style="width: 100%">
                    <div class="p-2">
                        <div class="back-button">
                            <a href="{{ route('classroom.index') }}#{{ $classroom->data->sn }}" id="back"></a>
                        </div>
                    </div>
                    @if(!empty($next_classroom))
                    <div class="p-2">
                        <div class="next-button">
                            <a href="{{ route('classroom.show',['classroom'=>$next_classroom,'host'=>$host->id,'curricula'=>$curricula]) }}" id="back"></a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <video id="myMediaElementID" controls controlsList="nodownload">
                <source src="{{ $host->attr.$classroom->attr }}" type="video/mp4">
            </video>
        </div>
    </div>
</div>
<div class="d-flex flex-column">
    <div class="p-2">
        <div class="d-flex justify-content-between">
            <div class="p-2">
                <a href="{{ route('classroom.index') }}#{{ $classroom->data->sn }}" class="div-back" style="font-size: 1.2rem;text-decoration: none;color: black"><i class="fas fa-angle-left"></i> 回課程目錄</a>
            </div>
            <div class="p-2">
                @if(!empty($next_classroom))
                    <a href="{{ route('classroom.show',['classroom'=>$next_classroom,'host'=>$host->id,'curricula'=>$curricula]) }}" class="div-next" style="font-size: 1.2rem;text-decoration: none;color: black">下一集  <i class="fas fa-angle-right"></i></a>
                @endif
            </div>
        </div>
        <div class="txt-border" style="font-size: 1.2rem">
            {!! $txt->txt('http:'.$host->resource_attr.$classroom->resource->where('type','txt')->first()->attr) !!}
        </div>
    </div>

</div>

<div class="fixed text-center" id="gotop" style="display:none">
    <i class="fas fa-caret-up"></i>
</div>

@include('Frontplatform.layouts.footer')
@include('Frontplatform.modals.login')
@if(Auth::check())
    @include('Frontplatform.modals.logout')
@endif
<script src="https://kit.fontawesome.com/847b731f5e.js" crossorigin="anonymous"></script>

</body>

</html>

