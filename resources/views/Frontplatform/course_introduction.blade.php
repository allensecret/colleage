@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .list {
            padding-bottom: 1rem;
            font-size: 1.1rem;
            margin-left: 4em;
            text-indent: -4em;
        }

        .class_button{
            border-radius: 15px;
            padding: 10px 20px 10px 20px;
            font-size: 1.2rem;
            background-color: rgb(247, 245, 241);
            color: #000000;
            font-family: 'DFXingShuStd-W5';
        }

        .class_button:hover{
            background-color: rgb(144,143,141);
            color: white;
            text-decoration: none;
        }

        .class_button.active{
            color: white;
            background-color: rgb(144, 143, 141);
        }

        .nav-pills .nav-link.active{
            margin-left: 20px;
            margin-right: 20px;
            border-radius: 15px;
            background-color: rgb(144, 143, 141);
        }

        .nav-item .nav-link:hover{
            font-size: 1.3rem ;
        }

        .nav-item .nav-link {
            font-size: 1.3rem;
        }


        .table thead tr th {
            border-bottom: 3px solid #dee2e6;
        }

        .table>tbody>tr:last-child {
            border-bottom: 3px solid #dee2e6;
        }

        .nav-pills .nav-item a{
            color: black;
        }

        .nav-pills .nav-item a:hover{
            color: white;
        }

        .tab-content{
            overflow-x:auto;
        }

        table thead tr{
            font-size: 1.2rem;
            font-family: 'DFXingShuStd-W5';
            white-space:nowrap;
        }

        table tbody tr{
            font-size: 1rem;
            white-space:nowrap;
        }

        .nav_div{
            font-size: 1.3rem;
        }

        @media only screen and (min-width: 415px) and (max-width: 1024px) {
            .nav_div{
                font-size: 1.1rem;
            }

            .nav-item .nav-link:hover{
                font-size: 1.2rem ;
            }

            .nav-item .nav-link {
                font-size: 1.2rem;
            }

            .class_button{
                border-radius: 15px;
                padding: 10px 10px 10px 10px;
                font-size: 1.2rem;
                background-color: rgb(247, 245, 241);
                color: #000000;
                font-family: 'DFXingShuStd-W5';
            }

            .nav-pills .nav-link.active{
                margin-left: 10px;
                margin-right: 10px;
                border-radius: 15px;
                background-color: rgb(144, 143, 141);
            }
        }

        @media only screen and (max-width: 415px) {
            .nav_div{
                font-size: 1rem;
                padding-bottom: 1rem;
            }

            .nav-pills .nav-link.active{
                margin-left: 5px;
                margin-right: 5px;
                border-radius: 15px;
                background-color: rgb(144, 143, 141);
            }

            .nav-item .nav-link:hover{
                font-size: 1rem ;
            }

            .nav-item .nav-link {
                font-size: 1rem;
            }

            .class_button{
                border-radius: 15px;
                padding: 10px 10px 10px 10px;
                font-size: 1rem;
                background-color: rgb(247, 245, 241);
                color: #000000;
                font-family: 'DFXingShuStd-W5';
            }
        }
    </style>
@endpush
@section('content')
<div class="row div-content">
    <div class="col-12 pb-3">
        <div class="d-flex justify-content-center flex-wrap text-center nav_div">
            <div class="p-2">
                <a class="guide_link font-DFXing" href="{{ route('guide') }}" style="font-family:S5KFMM;">入學指導</a><span class="divider"></span>
            </div>
            @if(!\Illuminate\Support\Facades\Auth::check())
            <div class="p-2">
                <a class="guide_link font-DFXing" href="{{ route('registration.index') }}" style="font-family:S5DUZF;">註冊報名</a><span class="divider"></span>
            </div>
            @endif
            <div class="p-2">
                <a class="guide_link font-DFXing active" href="{{ route('course_introduction') }}" style="font-family:S5JUVK;">課程介紹</a><span class="divider"></span>
            </div>
            <div class="p-2">
                <a class="guide_link font-DFXing" href="{{ route('calendar') }}" style="font-family:S5DSSU;">年度行事曆</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-6 text-left">
        <h1 style="font-family:S5JUVK;">課程介紹</h1>
    </div>
    <div class="col-12 col-md-8 col-lg-6 text-right">
        <div class="d-flex justify-content-around">
            @foreach($course as $c)
                <div class="p-2">
                    <a class="class_button {{ $select_course == $c->id ? 'active':"" }}" href="{{ route('course_introduction',['select_course'=>$c->id]) }}">{{ $c->name }}</a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 div-introduction">
        {!! $course_content->intro !!}
    </div>


    <div class="col-12">
        <ul class="nav nav-pills nav-justified">
            @foreach($course_level as $cl)
             <li class="nav-item">
                <a class="nav-link @if($loop->first) active @endif " data-toggle="pill" href="#table_{{ $cl->id }}">{{ $cl->level }}</a>
            </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach($course_level as $cl)
                <div id="table_{{ $cl->id }}" class="container tab-pane @if($loop->first) active @endif"><br>
                    <div class="table-responsive">
                        <table class="table table-borderless text-center">
                            <thead>
                            <tr>
                                <th>課程編號</th>
                                <th>課程名稱</th>
                                <th>種類</th>
                                <th>授課老師</th>
                                <th>備註</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cl->curricula as $v)
                                <tr>
                                    <td>{{ $v->coursedata->sn }}</td>
                                    <td>{{ $v->coursedata->title }}</td>
                                    <td>{{ $v->compulsory == 1 ? "必修":"選修" }}</td>
                                    <td>{{ $v->coursedata->teacher }}</td>
                                    <td>{{ $v->remark }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
