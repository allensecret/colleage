@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .btn{
            font-family: 'DFXingShuStd-W5';
            font-size: 1.3rem;
            margin-right: 1.2rem;
            padding: 0px 30px 0px 30px;
            border-radius: 10px;
            border: none;
            background-color: rgb(207,203,197);
            color: white;
        }

        .btn:hover{
            background-color: rgb(143,154,160);
            color: white;
        }
    </style>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12 pb-3">
            <div class="d-flex justify-content-between">
                <div class="p-2"><h1>使用說明</h1></div>
                <div class="p-2"><a href="{{ route('merit.index') }}" class="btn">返回功過格</a> </div>
            </div>
        </div>
        <div class="col-12">
            {!! $data->content ?? "" !!}
        </div>
    </div>
@endsection
