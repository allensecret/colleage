@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .div-announcement{
            padding: 50px 150px 50px 150px;
            font-size: 1.2rem;
        }

        @media only screen and (max-width: 991px) {
            .div-announcement{
                padding: 50px 10px 50px 10px;
            }
        }
    </style>
@endpush
@section('content')
<div class="row div-content">
    <div class="col-12 col-lg-12 text-left">
        <h1><a href="{{ url()->previous() }}" style="color: rgb(154, 164, 170);"><i class="fas fa-angle-left"></i></a>&emsp;{{ $news->title }}</h1>
    </div>
    <div class="col-12 div-announcement">
        {!! $news->content !!}
    </div>
</div>
@endsection
