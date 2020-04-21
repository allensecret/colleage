@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .message_img{
            width: 100%;
            height: 300px;
        }

        @if(Auth::check())
        .card {
            box-shadow: 4px 4px 12px -5px rgba(20%, 20%, 40%, 0.3);
            border-radius: 0;
            border-style: none;
        }
        @endif

        .introduction-text{
            max-width: 90%;
            margin: 0 8%;
            line-height: 60px;
        }

        .image img{
            width: 100%;
        }

        .image{
            border-radius: 10px;
            background-color: rgb(246, 244, 239);
            height: 150px;
            width: 150px
        }

        .introduction-text p{
            font-size: 1rem !important;
        }

        @media only screen and (min-width: 1024px) and (max-width: 1440px) {
            .introduction-text{
                max-width: 90%;
                margin: 0 5%;
                line-height: 60px;
            }
        }

        @media only screen and (min-width: 426px) and (max-width: 1024px) {
            .introduction-text{
                max-width: 90%;
                margin: 0 5%;
                line-height: 35px;
            }

            /*.image img{*/
                /*width: 100%;*/
            /*}*/

            .image{
                border-radius: 10px;
                background-color: rgb(246, 244, 239);
                height: 80px;
                width: 80px
            }

            .introduction-text p{
                font-size: 0.85rem !important;
            }
        }

        @media only screen and (max-width: 425px) {
            .introduction-text{
                max-width: 90%;
                margin: 0 5%;
                line-height: 20px;
            }

            .image{
                border-radius: 10px;
                background-color: rgb(246, 244, 239);
                height: 100px;
                width: 100px
            }
        }

    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            @if ($errors->first('order_email')|| $errors->first('repeat_email') || \Illuminate\Support\Facades\Session::has('success'))
                $("#success_order").modal();
            @endif

            $('#disorder').click(function () {
                $('.order-form').attr('action','{{route('disorder')}}')
            });

            @if($announcement_config->config == 1)
                $('#announcement').modal();
            @endif

            // $('#divide').modal();
        });
    </script>
@endpush
@section('content')
    @if(Auth::check())
        <div class="row text-center div-content">
            <div class="col-12 col-sm-4 col-lg-4 pb-3">
                <div class="card">
                    <a href="{{ route('discussion.index',[],false) }}" style="text-decoration: none;color: black;">
                        <img class="card-img-top" src="/img/new_frontplatform/student_border_2.jpg" alt="Card image" style="width:100%">
                        <div class="card-body text-center" style="padding-top: 0;padding-bottom: 80px">
                            <p class="card-text">請依照分類發文，禁止轉帖其他網站內容及連結。發文前請先搜尋有無相關資訊，確定沒有再發文。
                                此專區係提供學院同學專用之討論版，若有不宜公開之私人問題，請用電子信箱<a href="mailto:amtb@amtb.tw">amtb@amtb.tw</a>聯絡。</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 pb-3">
                <div class="card">
                    <a href="{{ route('classroom.index') }}" style="text-decoration:none;color:black">
                        <img class="card-img-top" src="/img/new_frontplatform/student_border_1.jpg" alt="Card image" style="width:100%">
                        <div class="card-body text-center" style="padding-top: 0;padding-bottom: 80px">
                            <p class="card-text">課程以淨空老和尚辦學的九年學程為主軸，每日課程為2.5小時。新同學請先註冊報名，再用帳號登入「學生中心」參與學習研討。</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-lg-4 pb-3">
                <div class="card">
                    <a href="{{ route('merit.index') }}" style="text-decoration:none;color:black">
                        <img class="card-img-top" src="/img/new_frontplatform/student_border_3.jpg" alt="Card image" style="width:100%">
                        <div class="card-body text-center" style="padding-top: 0;padding-bottom: 80px">
                            <p class="card-text">功過格是記錄自己每天的功課，可自行增加功課，如念佛、誦經，自訂數量，日日堅持行之，以此記錄，自我鼓勵。其他如弟子規等，請配合課程記錄，以輔助自己改過向善!</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row div-content">
            <div class="col-12 col-sm-12 col-md-6 col-xl-6 pb-3">
                <a href="{{ route('teacher_introduction') }}">
                <img src="/img/new_frontplatform/jd.jpg" style="width: 100%">
                </a>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-6">
                <a href="{{ route('teacher_introduction') }}">
                <img src="/img/new_frontplatform/wd.jpg" style="width: 100%">
                </a>
            </div>
        </div>
    @else
        <div class="row div-content">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title pb-3" style="font-family:S5XXYD;">認識學院</h1>
                        <div class="introduction-text">
                            {!! $page->content  !!}
                        </div>
                        <div class="text-right">
                            <a href="{{ route('introduction') }}" class="btn button" style="font-family:S5XOSB;">了解更多</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title pb-3" style="font-family:S5XEXL;">導師陣容</h1>
                        <div class="d-flex justify-content-around flex-wrap">
                            @foreach($teacher_introduction as $t)
                            <div class="p-2 text-center">
                                <div class="image" style="margin: 0px auto">
                                    <img src="/storage/img/{{ $t->img }}" alt="">
                                </div>
                                <p class="pt-3" style="font-size: 1.2rem">{{ $t->name }}</p>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-right">
                            <a href="{{ route('teacher_introduction') }}" class="btn button" style="font-family:S5XOSB;">了解更多</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif



    <div class="row text-center div-content">
        @foreach($news_type as $t)
        <div class="col-12 col-sm-12 col-md-4 col-xl-4 pb-3" style="font-size: 0.9rem">
            <img src="/img/new_frontplatform/{{ $t->image }}" style="width: 100%">
            @foreach($t->bulletin()->orderBy('created_at','desc')->get()->take(5) as $v)
                <a href="{{ route('news.show',['news'=>$v]) }}" style="text-decoration:none;color: black;">
                    <div class="row pb-3" style="margin: 0px auto;font-size: 1.2rem">
                        <div class="col-7 text-left" style="padding: 0">{{ $v->title }}</div>
                        <div class="col-5 text-right" style="padding: 0">{{ date('Y-m-d',strtotime($v->created_at)) }}</div>
                    </div>
                </a>
            @endforeach
            <div class="text-right">
                <a href="{{ route('news.index',['news_type'=>$t->id]) }}" class="btn button" style="font-family:S5BLKG;"> 更多...</a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row text-center div-content">
        <div class="col-12 col-lg-12 order-block">
            <div class="order_div_text">
                佛陀教育雜誌
            </div>
            <div class="order_div">
                <button class="btn order_button" data-toggle="modal" data-target="#success_order">訂閱</button>
            </div>
        </div>
    </div>
    @include('Frontplatform.modals.success_order')
    @include('Frontplatform.modals.announcement')
    @include('Frontplatform.modals.divide')
@endsection
