@extends('Frontplatform.layouts.layout')
@push('style')
    <style>

        .image-container{
            max-width: 80%;

            margin: 0 10%;
        }

        img{
            width: 100%;
        }

        .introduction{
            font-size: 1.3rem;
        }
        @media only screen and (min-width: 415px) and (max-width: 1024px) {
            h1{
                font-size: 1.6rem;
                color: rgba(0, 0, 0, 0.7);
            }

            .image-container{
                max-width: 100%;
                margin: 0 3%;
            }

            img{
                width: 100%;
            }

            .introduction{
                font-size: 1.3rem;
            }
        }

        @media only screen and (max-width: 415px) {
            h1{
                font-size: 1.6rem;
                color: rgba(0, 0, 0, 0.7);
            }

            .image-container{
                max-width: 100%;
                margin: 0 3%;
            }

            img{
                width: 100%;
            }

            .introduction{
                font-size: 1.1rem;
            }
        }
    </style>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12 text-center nav_div">
            <a class="guide_link font-DFXing active" href="{{ route('teacher_introduction') }}">導師介紹</a> ｜ <a class="guide_link font-DFXing" href="{{ route('introduction') }}">成立緣起</a>
        </div>
        <div class="col-12 pb-3 pt-3">
            <h1><a href="{{ route('teacher_introduction') }}" style="color: rgb(154, 164, 170);"><i class="fas fa-angle-left"></i></a>   {{ $teacher->name }}</h1>
        </div>
        <div class="col-12">
            <div class="row image-container">
                <div class="col-12 col-md-6 col-lg-6">
                    <img src="{{ asset('storage/img/'.$teacher->img) }}">
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <h1>相關連結</h1>
                    <hr>
                    @foreach(json_decode($teacher->attr) as $attr)
                        <a href="{{ $attr }}">{{ $attr }}</a>
                    @endforeach
                </div>
                <div class="col-12 pt-3 introduction">
                    <h1>法師簡介：</h1>
                    {!! $teacher->introduction  !!}
                </div>
            </div>

        </div>
    </div>
@endsection
