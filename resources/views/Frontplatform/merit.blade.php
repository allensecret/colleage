@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        /*.relative1 {*/
            /*position: relative;*/
            /*margin: 20px;*/
            /*width: 250px;*/
            /*height: 250px;*/
            /*border-radius: 10px;*/
            /*box-shadow: 4px 4px 5px -1px rgba(20%, 20%, 40%, 0.1);*/
            /*background-color: white;*/
            /*float: left;*/

        /*}*/

        /*.relative2 {*/
            /*float: left;*/
            /*position: relative;*/
            /*margin: 0 auto;*/
            /*top: -320px;*/
            /*left: 0px;*/
            /*background-color: rgb(247, 245, 241);*/
            /*width: 250px;*/
            /*height: 250px;*/
            /*border-radius: 10px;*/
        /*}*/

        .btn{
            font-family: 'DFXingShuStd-W5';
            font-size: 1.3rem;
            margin-right: 1.2rem;
            margin-bottom: 1rem;
            padding: 0px 100px 0px 100px;
            border-radius: 10px;
            border: none;
            background-color: rgb(207,203,197);
            color: white;
        }

        .btn:hover{
            background-color: rgb(143,154,160);
            color: white;
        }

        .relative1 {
            position: relative;
            margin: 0 auto;
            top: -150px;
            width: 200px;
            height: 200px;
            border-radius: 10px;
            box-shadow: 4px 4px 5px -1px rgba(20%, 20%, 40%, 0.1);
        }

        .relative2 {
            position: relative;
            margin: 0 auto;

            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-color: rgb(247, 245, 241);
            width: 200px;
            height: 200px;
            border-radius: 10px;
            z-index: 1;
        }

        .relative2:hover{
            cursor:pointer;
        }

        .card-div{
            height: 300px;
        }

        .text{
            position: absolute;
            width: 100%;
            bottom: 10px;
            display: flex;
            margin: auto;
        }

        .text-p{
            margin: auto; /* Important */
            text-align: center;
        }

        @media only screen and (max-width: 991px) {
            .div-content{
                margin:0px 10px 30px 10px;
            }

            .block-img{
                width: 200px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12 pb-3">
            <h1 style="font-family:S5YYUX;">功過格</h1>
        </div>

        <div class="col-12">
            <div class="d-flex justify-content-around flex-wrap">
                @foreach($data as $d)
                    <div class="p-2 card-div">
                        <div class="relative2" style="background-image: url('{{ asset('storage/merit_img/'.$d->img) }}')" onclick="location.href='{{ route('merit.show',['merit'=>$d]) }}'"></div>
                        <div class="relative1" style="background-color: white;">
                            <div class="text">
                                <p class="text-p">{{ $d->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-12 pt-5 text-center">
            <a href="{{ route('merit.rule') }}" class="btn">修行守則</a>
            <a href="{{ route('merit.explanation') }}" class="btn">使用說明</a>
        </div>
    </div>
@endsection
