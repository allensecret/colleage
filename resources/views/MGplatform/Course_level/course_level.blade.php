@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=course_li]').addClass('active');
            $('div[name=course]').addClass('show');
        });
    </script>
@endpush
@push('style')
    <style>
        .card{
            margin-top: 1%;
        }
        .card-header{
            font-size: 2rem;
        }
    </style>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">科目學分課程</li>
        <li class="breadcrumb-item text_label"><b>學科年級</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="row align-items-stretch">
        <div class="col-12">
            <div class="row">
                @foreach($data as $v)
                <div class="col-12 pt-3">
                        <h1>
                            <div class="row">
                                <div class="col-6">{{ $v->name }}</div>
                                <div class="col-6 text-right">
                                    @can('course_level.create')
                                    <a href="{{ route('course_level.create',['course'=>$v]) }}" class="btn btn-success btn-lg"><i class="fas fa-plus"></i></a>
                                    @endcan
                                </div>
                            </div>
                        </h1>
                        <hr>
                        @foreach($v->course_level as $name)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete{{ $name->id }}">{{ $name->level }}</button>
                        @endforeach
                </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
@can('course_level.delete')
@include('MGplatform.Course_level.modals.course_level_delete')
@endcan
