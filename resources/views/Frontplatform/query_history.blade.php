@extends('Frontplatform.layouts.layout')
@push('style')
    <style>

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

        .fa-file-alt{
            font-size: 1.3rem;
        }

        a{
            color: black;
        }

        .dropdown-toggle{
            color: white;
            padding-right: 50px;
            padding-left: 50px;
            font-size: 1.1rem;
            background-color: rgb(207,203,197);
            border: none;
            border-radius: 10px;
            box-shadow: 4px 4px 5px 1px rgba(20%, 20%, 40%, 0.2);
        }

        .dropdown-toggle:hover{
            color: white;
            background-color: rgb(207,203,197);
            border: none;
        }

        .dropdown-toggle:focus{
            background-color: rgb(207,203,197);
            border: none;
        }

        .dropdown-toggle::after{
            vertical-align: 0;
            font-size: 2.2rem;
        }

        p{
            font-size: 1.1rem;
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

            @foreach($curriculas as $c)
                @if($c->grade == "")
                tbody tr:nth-child({{ $loop->iteration }}) > td:nth-child(4){
                    display: none;
                }
                @endif
                @if($c->done != 2)
                tbody tr:nth-child({{ $loop->iteration }}) > td:nth-child(5){
                    display: none;
                }
                @endif
            @endforeach
        }
    </style>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12 pb-4">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8"><h1 style="font-family:S5EEJA;">查詢歷年課程成績</h1></div>
                <div class="col-12 col-md-6 col-lg-4 text-right">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                        {{ \Illuminate\Support\Facades\Auth::user()->data->level->level }}
                    </button>
                    <div class="dropdown-menu">
                        @foreach($history as $h)
                            <a class="dropdown-item" href="#">{{ $h->level }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 text-center table-div">
            <table>
                <thead>
                <tr>
                    <th scope="col">課程編號</th>
                    <th scope="col">課程名稱</th>
                    <th scope="col">種類</th>
                    <th scope="col">成績</th>
                    <th scope="col">報告內容</th>
                </tr>
                </thead>
                <tbody>
                @foreach($curriculas as $c)
                    <tr>
                        <td data-label="課程編號">{{ $c->course->coursedata->sn }}</td>
                        <td data-label="課程名稱">{{ $c->course->coursedata->title }}</td>
                        <td data-label="種類">{{ $c->course->compulsory == '1' ? '必修':'選修' }}</td>
                        <td data-label="成績">{{ $c->grade }}</td>
                        <td data-label="報告內容">
                            @if($c->done == 2)
                                <a href="#report{{ $c->id }}" data-toggle="modal"><i class="far fa-file-alt"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('Frontplatform.modals.query_history_content')
@endsection
