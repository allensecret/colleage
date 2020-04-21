@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .back_btn{
            font-family: 'DFXingShuStd-W5';
            font-size: 1.3rem;
            margin-right: 1.2rem;
            padding: 0px 50px 0px 50px;
            border-radius: 10px;
            border: none;
            background-color: rgb(207,203,197);
            color: white;
        }

        .back_btn:hover{
            background-color: rgb(143,154,160);
            color: white;
        }

        .img-div{
            padding: 100px 150px 100px 150px;
            background-color: rgb(246,244,239);
            border-radius: 10px;
            box-shadow: 4px 4px 5px 1px rgba(20%, 20%, 40%, 0.3);
        }

        p{
            font-size: 1.1rem;
        }

        .bar_graph{
            display: block; width: 100%; height: 100%;
            max-height: 400px; overflow: hidden;
            background-color: rgb(213,209,204);
        }



        .axis path, .axis line { fill: none; stroke: #555; }
        .axis text { fill: #555; }
        .line { fill: none; stroke: #ef0d0c; stroke-width: 1.5px; }

        rect{
            width: 20%;
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

            .bar_graph{
                margin: 30px;
            }

        }


        @media only screen and (min-width: 991px) and (max-width: 1024px) {
            .div-content{
                margin:0px 30px 30px 30px;
            }

        }


        @media only screen and (max-width: 991px) {
            .back_btn{
                font-family: 'DFXingShuStd-W5';
                font-size: 1.3rem;
                margin-right: 1.2rem;
                padding: 0px 30px 0px 30px;
                border-radius: 10px;
                border: none;
                background-color: rgb(207,203,197);
                color: white;
            }
            .div-content{
                margin:0px 10px 30px 10px;
            }

            .img-div{
                padding: 50px 20px 100px 20px;
                background-color: rgb(246,244,239);
                border-radius: 10px;
                box-shadow: 4px 4px 5px 1px rgba(20%, 20%, 40%, 0.3);
            }

            .bar_graph{
                display: block; width: 100%; height: 100%;
                /*min-width: 300px; max-width: 960px; max-height: 500px; overflow: hidden;*/
            }

            .bar_graph{
                background-color: rgb(213,209,204);
            }

            rect{
                width: 9%;
            }
        }
    </style>
@endpush
@push('scripts')
    {{--<script src="https://d3js.org/d3.v3.min.js"></script>--}}
    {{--<script src="/js/frontplatform/d3_bar_graph.js"></script>--}}
    {{--todo 未自適應--}}
    {{--<script src="/js/frontplatform/d3_pie_chart.js"></script>--}}
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12 pb-3">
            <div class="d-flex justify-content-between">
                <div class="p-2"><h1>{{ $merit->name }}評量表</h1></div>
                <div class="p-2"><a href="{{ route('merit.index') }}" class="btn back_btn">返回目錄</a> </div>
            </div>
        </div>
        <div class="col-12 img-div">
            <table class="table">
                <thead>
                <tr>
                    <th>日期</th>
                    <th>分數</th>
                    <th>功</th>
                    <th>過</th>
                    <th class="text-center">重新評量</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{ date('Y-m-d',strtotime($d->created_at)) }}</td>
                        <td>{{ $d->grade }}</td>
                        <td>{{ count(mb_split(";",$d->yes))-1 }}</td>
                        <td>{{ count(mb_split(";",$d->no))-1 }}</td>
                        <td class="text-center"><a href="{{ route('merit.edit',['merit'=>$d]) }}"><i class="fas fa-edit"></i></a> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{--<p>分數計量表</p>--}}
            {{--<div class="bar_graph text-center"></div>--}}
            {{--<p class="pt-5">統計圖表</p>--}}
            {{--<div class="pie_chart text-center"></div>--}}
        </div>
    </div>
@endsection
