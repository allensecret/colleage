@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .number_list {
             padding-bottom: 1rem;
             font-size: 1.1rem;
             margin-left: 2em;
             text-indent: -2em;
         }

        p{
            font-size: 1.3rem!important;
        }
        sub{
            font-size: 1.4rem;padding-left: 1.4em;
        }

        @media only screen and (min-width: 415px) and (max-width: 1024px) {

        }

        @media only screen and (max-width: 415px) {

        }
    </style>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12 text-center nav_div">
            <a class="font-DFXing guide_link " href="{{ route('teacher_introduction') }}" style="font-family:S5PMUH;">導師介紹</a> ｜ <a class="guide_link active font-DFXing" href="{{ route('introduction') }}" style="font-family:S5WCEG;">成立緣起</a>
        </div>
        <div class="col-12 pb-5">
            <h1 style="font-family:S5WCEG;">成立緣起</h1>
            <div class="row">
                <div class="col-12 div-text-content">
                    {!! $data[0]->content !!}
                </div>
            </div>
        </div>
        <div class="col-12 pb-5">
            <h1 style="font-family:S5BXPP;">教學宗旨</h1>
            <div class="row">
                <div class="col-12 div-text-content">
                    {!! $data[1]->content !!}
                </div>
            </div>
        </div>

        <div class="col-12 pb-5">
            <h1 style="font-family:S5BYHF;">學院院訓 <sub style="font-family:S5GJZA;">「敦倫盡分，閑邪存誠，老實念佛，求生淨土。」</sub></h1>
            <div class="row">
                <div class="col-12 div-text-content">
                    {!! $data[2]->content !!}
                </div>
            </div>
        </div>

        <div class="col-12 pb-5">
            <h1 style="font-family:S5SYXN;">教學方式</h1>
            <div class="row">
                <div class="col-12 div-text-content">
                    {!! $data[3]->content !!}

                </div>
            </div>
        </div>

        <div class="col-12 pb-5">
            <h1 style="font-family:S5JCVU;">修學介紹</h1>
            <div class="row">
                <div class="col-12 div-text-content">
                    {!! $data[4]->content !!}
                </div>
            </div>
        </div>

        <div class="col-12 pb-5">
            <h1 style="font-family:S5KRSH;">未來展望</h1>
            <div class="row">
                <div class="col-12 div-text-content">
                    {!! $data[5]->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
