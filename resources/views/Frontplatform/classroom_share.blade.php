@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .black{
            color: black;
        }
        .black:hover{
            color: black;
            text-decoration: none;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {

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
        });
    </script>

@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12">
            <div class="row">
                <div class="col-12 text-left"><h1><a href="{{ route('classroom.index') }}" style="color: rgb(154, 164, 170);"><i class="fas fa-angle-left"></i></a> 心得分享</h1></div>
            </div>
        </div>
        <div class="col-12 pt-5">
            @foreach($share_report as $d )
                <div class="row pb-5">
                    <div class="col-12 col-lg-6" style="font-size: 1.3rem">學號：{{ $d->student_name->account }}</div>
                    <div class="col-12 col-lg-6 text-right">日期：{{ date('Y-m-d',strtotime($d->created_at)) }}</div>
                    <div class="col-12 pt-3">
                        {!! $d->content !!}
                    </div>
                </div>
            @endforeach

            <div class="fixed text-center" id="gotop" style="display:none">
                <i class="fas fa-caret-up"></i>
            </div>
        </div>
    </div>
@endsection
