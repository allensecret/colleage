@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .image {
            border-radius: 10px;
            background-color: rgb(246, 244, 239);
            height: 240px;
            width: 240px;
            margin: 0 auto;
            margin-top: 15px;
        }

        label {
            font-size: 1.3rem;
        }

        .fa-check{
            color:green
        }

        .card-body {
            padding-left: 5px;
            padding-right: 5px;
            background-color: rgb(247, 245, 241);
        }

        .nav-pills .nav-item {
            padding-left: 30px;
            padding-right: 30px;
        }

        .nav-pills .nav-link {
            border-radius: 15px;
            background-color: rgb(247, 245, 241);
            color: black;
        }

        .nav-pills .nav-link.active {
            border-radius: 15px;
            background-color: rgb(144,143,141);
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#host').children().each(function () {
                if($(this).val() == "{{ $host }}"){
                    $(this).attr("selected","true");
                }
            });

            $("#host").change(function () {
                $("#host_form").submit();
            });

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
    @include('Frontplatform.layouts.alert')
<div class="row div-content">
    <div class="col-12">
        <div class="row">
            <div class="col-6 text-left"><h1>聽課教室</h1></div>
            <div class="col-6">
                <form class="form-inline" action="{{ route('classroom.index') }}" id="host_form" style="float: right" method="get">
                    <label for="host">主機：</label>
                    <select class="form-control" id="host" name="host">
                        <option value="5">自動</option>
                        <option value="1">台灣</option>
                        <option value="3">香港</option>
                        <option value="2">江蘇</option>
                        <option value="4">德國</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        @foreach(Auth::user()->curriculas as $c)
            <div class="row pb-5" id="{{ $c->course->coursedata->sn }}">
                <div class="col-12 col-lg-3">
                    <div class="image"></div>
                </div>
                <div class="col-12 col-lg-9 pt-3">
                    <div class="row">
                        <div class="col-12 col-lg-7 text-left">
                            <h2>{{ $c->course->coursedata->sn }}_{{ $c->course->coursedata->title }}</h2>
                        </div>
                        <div class="col-12 col-lg-5 text-right" style="padding: 0">
                            <div class="d-flex ">
                                <div class="p-1 flex-fill"><a href="#" class="btn dl_btn" data-toggle="modal" data-target="#page_download{{ $c->id }}">講義下載</a></div>
                                <div class="p-1 flex-fill"><a href="#" class="btn dl_btn" data-toggle="modal" data-target="#vide_download{{ $c->id }}">影音下載</a></div>
                                @if($c->course->report == 1)
                                    <div class="p-1 flex-fill"><a href="{{ route('experience',['sn'=>$c->course->coursedata->sn]) }}" class="btn dl_btn">心得分享</a></div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 pt-3">
                            {{ $c->course->coursedata->introduction }}
                        </div>
                        <div class="col-12 mb-0">
                            備註：
                            {{ $c->course->remark }}
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header" style="background-color:rgb(213,209,205);">
                            <div class="row">
                                <div class="col-6">課程集數</div>
                                <div class="col-6 text-right"><a class="card-link" data-toggle="collapse" data-target="#collapse{{ $c->id }}">展開 <i class="fas fa-angle-down"></i></a></div>
                            </div>
                        </div>
                        <div id="collapse{{ $c->id }}" class="collapse show">
                            <div class="card-body">
                                @if(\Illuminate\Support\Facades\Session::has('success_'.$c->course->coursedata->sn))
                                    <div class="alert alert-success div-content">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <i class="fas fa-check"></i>  {{ \Illuminate\Support\Facades\Session::get('success_'.$c->course->coursedata->sn) }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger div-content">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-6">
                                        <a href="#" data-toggle="modal" data-target="#custom{{ $c->id }}">自訂已完成課程內容</a>
                                    </div>
                                    <div class="col-6 text-right">
                                        共{{ $c->course->coursedata->get_media->count() }}集
                                    </div>
                                    <div class="col-12 pt-3" style="padding: 0px">
                                        <div class="row text-center">
                                            @foreach($c->course->coursedata->get_media as $m)
                                                <div class="col-4 col-lg-2 mb-3" style="padding: 0px">
                                                    <a href="{{ route('classroom.show',['classroome'=>$m->id,'host'=>$host,'curricula'=>$c->id]) }}" class="btn ep_btn">
                                                        @if(in_array($m->course_data.'_'.$m->ep,mb_split(';',$c->done_ep)) != null)
                                                            <i class="fas fa-check"></i>
                                                        @endif
                                                        第{{ $m->ep }}集
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12 pt-4 pb-3 text-right">
                                        @if($c->course->report == 1)
                                            @if($c->done == 0)
                                                <a href="{{ route('report.show',['report'=>$c]) }}" class="btn report_btn"><i class="fas fa-file-upload"></i> 提交報告</a>
                                            @else
                                                <a href="{{ route('report.index') }}" class="btn report_btn">已提交報告</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

            <div class="fixed text-center" id="gotop" style="display:none">
                <i class="fas fa-caret-up"></i>
            </div>
    </div>
</div>
    @include('Frontplatform.modals.classroom_difine')
    @include('Frontplatform.modals.classroom_page_download')
    @include('Frontplatform.modals.classroom_video_download')
@endsection
