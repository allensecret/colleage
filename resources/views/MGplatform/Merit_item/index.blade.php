@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=merit_li]').addClass('active');
            $('div[name=merit]').addClass('show');
        });
    </script>
@endpush
@push('style')
    <style>
        a:hover{

            text-decoration:none;
        }
    </style>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">功過格</li>
        <li class="breadcrumb-item text_label"><b>課題</b></li>
    </ol>
@endsection
@section('content')
    <div class="row align-items-stretch">
        <div class="col-12">
            <div class="row">

                <div class="col-12 pt-3">
                    <div class="card-columns">
                        @foreach($data as $d)
                        <div class="card" style="height: 150px">
                            <div class="card-body text-center" style="margin: 0 auto">
                                <p class="card-text" style="font-size: 1.4rem;">
                                    <a href="{{ route('merit_item_MG.show',['merit_item_MG'=>$d]) }}">{{ $d->name }}</a>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

