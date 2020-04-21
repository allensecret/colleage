<!DOCTYPE html>
<html lang="en">

<head>
    <title>佛陀教育網路學院</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="/img/frontplatform/logo.ico">
    <link href="https://fonts.googleapis.com/css?family=Zhi+Mang+Xing&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="/css/frontplatform/my_css.css">
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.0/css/all.min.css">
{{--    @include('Frontplatform.layouts.font')--}}

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui@1.12.1/ui/widget.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    {{--<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.js"></script>
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

            @if($errors->first('account') || $errors->first('password'))
                $('#login').modal();
            @endif

            $('textarea').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['undo',['undo']],
                    ['fontname',['fontname']]
                ],
                height: 300,
                shortcuts:false
            }).summernote('fontSize',18);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    @stack('style')

</head>

<body>
    @include('Frontplatform.layouts.nav')

    @include('Frontplatform.layouts.carousel')

    @yield('content')

    @include('Frontplatform.layouts.footer')
    @include('Frontplatform.modals.login')
    @if(Auth::check())
        @include('Frontplatform.modals.logout')
    @endif


</body>

</html>

