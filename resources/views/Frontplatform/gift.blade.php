<!DOCTYPE html>
<html lang="en">

<head>
    <title>佛陀教育網路學院</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="/img/frontplatform/logo.ico">
    <link href="https://fonts.googleapis.com/css?family=Zhi+Mang+Xing&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/frontplatform/my_css.css">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">

    <script src="/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
    {{--<script>FontJSON = { User: "9856", DomainID: "freeUQYGDASDZTNAI", Font: ["DFXingShuStd-W5"] }</script>--}}
    {{--<script src='https://dfo.dynacw.com.tw/DynaJSFont/DynaFont.js'></script>--}}
    <script src="https://kit.fontawesome.com/847b731f5e.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    <script>
        $(document).ready(function () {
            $(window).scroll(function() {
                if ( $(this).scrollTop() > 500){
                    $('#gotop').fadeIn("fast");
                } else {
                    $('#gotop').stop().fadeOut("fast");
                }
            });

        });
    </script>
    <style>
        .container-fluid{
            padding: 50px 150px 10px 150px
        }
        .custom-control-label{
            font-size: 1.2rem;
        }

        @media only screen and (max-width: 991px) {
            .container-fluid{
                padding: 50px 10px 10px 10px
            }
        }
    </style>
</head>

<body>
@include('Frontplatform.layouts.nav')

<div class="row div-content">
    @include('Frontplatform.layouts.alert')
    <div class="col-12">
        <div class="container-fluid">
            <h3 class="pb-3">恭喜{{ $student->name }}（{{ $student->account }}）成功升學（畢業）將會發送您的禮品到您的所在地， 確保能讓您收到禮品，請務必填寫正確地址與收件人</h3>
            <form action="{{ route('gift.store',['student'=>$student->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <h4>升學禮品：</h4>
                    @foreach($item as $i)
                        <div class="form-check-inline">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="gift{{ $loop->iteration }}" value="{{ $i->id }}" name="gift[]">
                                <label class="custom-control-label" for="gift{{ $loop->iteration }}">{{ $i->name }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="address" style="font-size: 1.35rem">寄送地址：</label>
                    <input type="text" class="form-control" id="address" name="send_address">
                </div>
                <div class="form-group">
                    <label for="name" style="font-size: 1.35rem">收件人：</label>
                    <input type="text" class="form-control" id="name" name="addressee">
                </div>
                <div class="form-group">
                    <label for="phone" style="font-size: 1.35rem">收件人電話：</label>
                    <input type="number" class="form-control" id="phone" name="phone">
                </div>
                <div class="d-flex justify-content-center">
                    <div class="p-2">
                        <button type="submit" class="btn btn-primary">送出</button>
                        <button type="reset" class="btn btn-warning">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('Frontplatform.layouts.footer')
@include('Frontplatform.modals.login')
@if(Auth::check())
    @include('Frontplatform.modals.logout')
@endif


</body>

</html>

