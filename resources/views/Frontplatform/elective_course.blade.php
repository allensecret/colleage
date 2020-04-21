@extends('Frontplatform.layouts.layout')
@push('style')
    <style>

        .col-12 h2{
            color: red;
            padding-bottom: 50px;
        }

        .number_list {
            padding-bottom: 1rem;
            font-size: 1.1rem;
            margin-left: 2em;
            text-indent: -2em;
        }

        p{
            font-size: 1.1rem;
        }

        h3{
            color: rgba(0,0,0, 0.7);
        }

        .form-div{
            padding: 0px 50px 10px 50px;
        }

        table{
            border-radius: 15px;
            background-color: rgb(246,244,239);
            box-shadow: 4px 4px 5px 1px rgba(20%, 20%, 40%, 0.3);
        }

        thead tr{
            color: rgba(0,0,0, 0.6);
            font-size: 1.5rem;
        }

        tbody tr{
            font-size: 1.1rem;
        }

        input[type="checkbox"]{
            width: 30px;
            height: 30px;
            top:0px;
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance:none;
            -o-appearance:none;
            border: 1px solid;
            border-radius: 5px;
            transition: all .3s linear;
            position: relative;
        }

        input[type="checkbox"]:checked:after{
            content: '\2713';
            position:absolute;
            left: 7px;
            font-size: 1.2rem;
            color: black;
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance:none;
            -o-appearance:none;
        }

        input[type="checkbox"]:focus{
            outline: 0 none;
            box-shadow: none;
        }

        .btn{
            font-family: 'DFXingShuStd-W5';
            font-size: 1.6rem;
            margin-right: 1.2rem;
            padding: 0px 120px 0px 120px;
            border-radius: 10px;
            border: none;
            background-color: rgb(207,203,197);
            color: #ffffff;
        }

        .btn:hover{
            color: white;
            background-color: rgb(143,154,160);
        }

        .hidden {
            display: none;
        }

        @media only screen and (max-width: 991px) {
            .table-div{
                padding: 0px 10px 10px 10px;
                overflow-x:auto;
            }

            table thead tr{
                white-space: nowrap;
            }

            table tbody tr{
                white-space: nowrap;
            }

        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
@section('content')
    @include('Frontplatform.layouts.alert')
    @if($config->config == 0)
    <div class="row div-content">
        <div class="col-12 text-center">
            <h2>~~ 選課時間已經結束 ~~</h2>
            <h2 >
            請在每年的四個開放選課時段<br> (4/1~4/7、7/1~7/7、10/1~10/7、1/1~1/7) <br>加選或退選課程
            </h2>
            <p>選課加課是一個參與學習的重要過程，每年都有開放幾個時段，讓同學們自己實際參與選課加課，以為修學的開始。</p>
            <p class="number_list">一、若是4月1日前註冊報名，在4月1日又未能升級的同學，在新學年開始後，則必須要選課，必修與選修都需要自己   選課方能提交報告;若您在新學年開始後，開放選課時(即4月1日至7日)未能按時選課，日後點擊「提交修學報告」   就會出現「查無今年度的資料」，則無法提交報告。雖不能提交報告，但是這並不影響您在本學院修學的任何權益，仍   可按正常程序來聽課學習，參與討論。在未選課前所修學過的課程報告，可先寫好存在電腦中，待下一個選課日選課後   再提交報告即可。</p>
            <p class="number_list">二、若您未升級且在新學年開始，開放選課時(即4月1日至7日)已按時選課，但是點擊「提交修學報告」後仍出現   「查無今年度的資料」，則請告知學院為您查詢處理，或是在7月1日開放選課時再自己選亦可。</p>
            <p class="number_list">三、若是已升級的同學，在新學年開始後，開放選課時(即4月1日至7日)未能按時選課者。在未選課前所修學過的課   程報告，可先寫好存在電腦中，待下一個選課日(7月1日至7日)選課後再提交報告即可。</p>
        </div>
    </div>
    @else
        <form class="row div-content" action="{{ route('elective_course.store') }}" method="post">
            @csrf
            <div class="col-12">
                <div class="d-flex">
                    <div class="p-2 flex-fill"><h1 style="font-family:S5EIOM;">選課加課</h1></div>
                    <div class="p-2 flex-fill align-self-end text-right"><h3 class="font-DFXing">{{ \Illuminate\Support\Facades\Auth::user()->data->level->level }}</h3></div>
                </div>
            </div>
            <div class="col-12 text-center table-div">
                <table class="table table-borderless">
                    <thead>
                    <tr class="font-DFXing">
                        <th>加課</th>
                        <th>課程編號</th>
                        <th>課程</th>
                        <th>授課老師</th>
                        <th>修別</th>
                        <th>備註</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($curricula as $c)
                        <tr>
                            <td><input type="checkbox" name="course[]" value="{{ $c->id }}"></td>
                            <td>{{ $c->coursedata->sn }}</td>
                            <td>{{ $c->coursedata->title }}</td>
                            <td>{{ $c->coursedata->teacher }}</td>
                            <td>
                                @switch($c->compulsory)
                                    @case(1)
                                    必修
                                    @break
                                    @case(2)
                                    選修
                                    @break
                                @endswitch
                            </td>
                            <td>{{ $c->remark }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-lg-6 text-center pb-3"><button class="btn" type="submit">送出</button></div>
            <div class="col-12 col-lg-6 text-center pb-3"><button class="btn" type="reset">重填</button></div>
        </form>
        <div class="row div-content">
            <div class="col-12">
                <div class="d-flex">
                    <div class="p-2 flex-fill"><h1>已選課</h1></div>
                </div>
            </div>
            <div class="col-12 text-center table-div">
                <table class="table table-borderless">
                    <thead>
                    <tr class="font-DFXing">
                        <th>取消</th>
                        <th>課程編號</th>
                        <th>課程</th>
                        <th>授課老師</th>
                        <th>修別</th>
                        <th>備註</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($has_curricula as $c)
                        <tr>
                            <td><a href="#delete{{ $c->id }}" data-toggle="modal"><i class="fas fa-minus" style="color: red"></i></a> </td>
                            <td>{{ $c->coursedata->sn }}</td>
                            <td>{{ $c->coursedata->title }}</td>
                            <td>{{ $c->coursedata->teacher }}</td>
                            <td>
                                @switch($c->compulsory)
                                    @case(1)
                                        必修
                                        @break
                                    @case(2)
                                        選修
                                        @break
                                @endswitch
                            </td>
                            <td>{{ $c->remark }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @include('Frontplatform.modals.elective_course_delete')
@endsection
