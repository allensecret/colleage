@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .relative1 {
            position: relative;
            margin: 0 auto;
            top: -200px;
            width: 250px;
            height: 250px;
            border-radius: 10px;
            box-shadow: 4px 4px 5px -1px rgba(20%, 20%, 40%, 0.1);
        }

        .relative2 {
            position: relative;
            margin: 0 auto;
            background-repeat: no-repeat;
            background-position: center;
            background-color: rgb(247, 245, 241);
            background-size: 250px 250px;
            width: 250px;
            height: 250px;
            border-radius: 10px;
            z-index: 1;
        }

        .card-div{
            height: 300px;
        }

        .relative2:hover{
            cursor:pointer;
        }

        @media only screen and (min-width: 1024px) {
            .card-div{
                padding:0 3rem 3rem 3rem !important;
            }

        }

        @media only screen and (min-width: 426px) and (max-width: 1024px) {
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
                background-position: center;
                background-color: rgb(247, 245, 241);
                background-size: 200px 200px;
                width: 200px;
                height: 200px;
                border-radius: 10px;
                z-index: 1;
            }

            .card-div{
                padding:0 2rem 2rem 2rem !important;
            }
        }

        @media only screen and (max-width: 425px) {
            .relative1 {
                position: relative;
                margin: 0 auto;
                top: -100px;
                width: 150px;
                height: 150px;
                border-radius: 10px;
                box-shadow: 4px 4px 5px -1px rgba(20%, 20%, 40%, 0.1);
            }

            .relative2 {
                position: relative;
                margin: 0 auto;
                background-repeat: no-repeat;
                background-position: center;
                background-color: rgb(247, 245, 241);
                background-size: 150px 150px;
                width: 150px;
                height: 150px;
                border-radius: 10px;
                z-index: 1;
            }
        }
    </style>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12 text-center nav_div">
            <a class="guide_link font-DFXing active" href="{{ route('teacher_introduction') }}" style="font-family:S5PMUH;">導師介紹</a> ｜ <a class="guide_link font-DFXing" href="{{ route('introduction') }}" style="font-family:S5WCEG;">成立緣起</a>
        </div>
        <div class="col-12 pb-3">
            <h1 style="font-family:S5PMUH;">導師介紹</h1>
        </div>
        <div class="col-12" style="padding-bottom: 5rem">
            <div class="d-flex justify-content-center flex-wrap">
                @foreach($teacher as $t)
                    <div class="p-2 card-div">
                        <a href="{{ route('teacher_introduction_detail',['teacher'=>$t]) }}" style="text-decoration: none;color: black">
                            <div class="relative2" data-toggle="modal" data-target="#detil{{ $t->id }}" style="background-image: url('{{ asset('storage/img/'.$t->img) }}')"></div>
                            <div class="relative1 d-flex justify-content-center align-items-end" data-toggle="modal" style="background-color: white;">
                                <div class="text">
                                    <p class="text-p">{{ $t->name }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
