@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .div-text{
            margin-left: 100px;
            font-size: 1.1rem;
        }
        .short{
            padding-left: 5em
        }
        .long{
            padding-left: 10em;text-indent: -5em;
        }

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

        @media only screen and (max-width: 991px) {
            .div-content{
                margin:0px 10px 30px 10px;
            }
            .div-text{
                margin-left: 10px;
                font-size: 1.1rem;
            }
        }
    </style>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12 pb-3">
            <div class="d-flex justify-content-between">
                <div class="p-2"><h1>修行守則</h1></div>
                <div class="p-2"><a href="{{ route('merit.index') }}" class="btn back_btn">返回目錄</a> </div>
            </div>
        </div>
        <div class="col-12 div-text">
            {!! $data->content ?? '' !!}
        </div>
    </div>
@endsection
