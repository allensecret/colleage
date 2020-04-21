@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        /*.table-div{*/
            /*padding: 10px 50px 10px 50px;*/
            /*background-color: rgb(246,244,239);*/
            /*border-radius: 10px;*/
            /*box-shadow: 4px 4px 5px 1px rgba(20%, 20%, 40%, 0.3);*/
            /*overflow-x:auto;*/
            /*display:block;*/
        /*}*/

        .modal-body{
            margin-left: 50px;
            margin-right: 50px;
        }

        table {
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
            border-radius: 10px;
            box-shadow:10px 10px 20px -7px rgba(20%,20%,40%,0.5);
        }

        table thead tr{
            background-color:rgb(246,244,239);
            font-size: 1.3rem;
            text-align: left;
        }

        tbody{
            background-color: rgb(246,244,239);
            font-size: 1.1rem;
        }

        table th,
        table td {
            text-align: center;
            padding: .625em;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        thead tr th:first-child{
            border-radius: 10px 0px 0px 0px;
        }

        thead tr th:last-child{
            border-radius: 0px 10px 0px 0px;
        }

        tbody tr:last-child td:first-child{
            border-radius: 0px 0px 0px 10px;
        }
        tbody tr:last-child td:last-child{
            border-radius: 0px 0px 10px 0px
        }

        /*1920~1680px*/
        @media only screen and (min-width: 1680px) and (max-width: 1920px) {
            .div-content{
                margin:10px 300px 30px 300px;
            }
        }

        /*1680~1440*/
        @media only screen and (min-width: 1440px) and (max-width: 1680px) {
            .div-content{
                margin:10px 200px 30px 200px;
            }
        }

        /*1440~1024*/
        @media only screen and (min-width: 1200px) and (max-width: 1440px) {
            .div-content{
                margin:0px 150px 30px 150px;
            }
        }

        /*1000~1200*/
        @media only screen and (min-width: 1000px) and (max-width: 1200px) {
            .div-content{
                margin:0px 30px 30px 30px;
            }
        }

        @media only screen and (min-width: 991px) and (max-width: 1024px) {
            .div-content{
                margin:0px 30px 30px 30px;
            }
        }

        @media only screen and (max-width: 991px) {
            .div-content{
                margin:0px 10px 30px 10px;
            }

            .table-div{
                padding: 10px 10px 10px 10px;
            }

            .modal-body{
                margin-left: 20px;
                margin-right: 20px;
            }
        }

        @media screen and (max-width: 700px) {

            table {
                border: 0;
                box-shadow: none;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
                border-radius: 10px;
                background-color: rgb(246,244,239);
                box-shadow:10px 10px 20px -7px rgba(20%,20%,40%,0.5);
            }

            tbody{
                background-color: white;
            }

            tbody tr td:first-child{
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: 1.1rem;
                text-align: right;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: 1.1rem;
                text-align: right;
            }

            table td::before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
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
    <div class="row div-content">
        <div class="col-12 pb-3">
            <h1 style="font-family:S5RKXX;">提交報告</h1>
        </div>
        <div class="col-12 table-div">
            <table>
                <thead>
                    <tr>
                        <th scope="col">提交時間</th>
                        <th scope="col">課程編號</th>
                        <th scope="col">標題</th>
                        <th scope="col">成績</th>
                        <th scope="col">審核狀態</th>
                        <th scope="col"></th>
                        <th scope="col">提交時間</th>
                    </tr>
                </thead>
                <tbody>
                @foreach(Auth::user()->curriculas as $c)
                    @if($c->course->level == \Illuminate\Support\Facades\Auth::user()->data->course_level)
                        @if($c->course->report == 1)
                            <tr>
                                <td data-label="提交時間：">年度內</td>
                                <td data-label="課程編號：">{{ $c->course->coursedata->sn }}</td>
                                <td data-label="標題：">{{ $c->course->coursedata->title }}</td>
                                <td data-label="成績	：" style="height: 51px">{{ $c->grade }}</td>
                                <td data-label="審核狀態：">
                                    @switch($c->done)
                                        @case(1)
                                        審核中
                                        @break
                                        @case(2)
                                        已審核
                                        @break
                                        @case(3)
                                        審核不過
                                        @break
                                        @default
                                        未審核
                                    @endswitch
                                </td>
                                <td>
                                    @switch($c->done)
                                        @case(0)
                                        <a href="{{ route('report.show',['report'=>$c]) }}" >提交報告</a>
                                        @break
                                        @case(1)
                                        <a href="{{ route('report.edit',['report'=>$c]) }}" >修改報告</a>
                                        @break
                                        @case(2)
                                        <a href="#check{{$c->id}}" data-toggle="modal">查看報告</a>
                                        @break
                                        @case(3)
                                        <a href="#check{{$c->id}}" data-toggle="modal">查看</a> ｜
                                        <a href="{{ route('report.edit',['report'=>$c]) }}" >重新提交</a>
                                        @break

                                    @endswitch
                                </td>
                                <td data-label="提交時間：" style="height: 51px">
                                    @if($c->done != 0)
                                        {{ date('Y-m-d',strtotime($c->report_date)) }}
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('Frontplatform.modals.report_check')
@endsection
