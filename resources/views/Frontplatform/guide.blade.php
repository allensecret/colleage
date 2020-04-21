@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        h2{
            font-family: 'DFXingShuStd-W5';
        }

        .content_div{
            max-width: 80%;
            margin: 0 10%;
            font-size: 1.3rem;
        }



        @media only screen and (min-width: 426px) and (max-width: 1024px) {
            .content_div{
                font-size: 1.1rem;
            }
        }

        @media only screen and (max-width: 425px) {
            .content_div{
                font-size: 1rem;
            }
        }
    </style>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12">
            <div class="d-flex justify-content-center flex-wrap text-center nav_div">
                <div class="p-2">
                    <a class="guide_link font-DFXing active" href="{{ route('guide') }}" style="font-family:S5KFMM;">入學指導</a><span class="divider"></span>
                </div>
                @if(!\Illuminate\Support\Facades\Auth::check())
                <div class="p-2">
                    <a class="guide_link font-DFXing" href="{{ route('registration.index') }}" style="font-family:S5DUZF;">註冊報名</a><span class="divider"></span>
                </div>
                @endif
                <div class="p-2">
                    <a class="guide_link font-DFXing" href="{{ route('course_introduction') }}" style="font-family:S5JUVK;">課程介紹</a><span class="divider"></span>
                </div>
                <div class="p-2">
                    <a class="guide_link font-DFXing" href="{{ route('calendar') }}" style="font-family:S5DSSU;">年度行事曆</a>
                </div>
            </div>
        </div>

        <div class="col-12 pb-4">
            <h1 style="font-family:S5KFMM;">入學指導</h1>
        </div>
        <div class="col-12 pb-5 content_div">
            {!! $data->content ?? "" !!}
        </div>
    </div>
@endsection
