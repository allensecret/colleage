@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=course_li]').addClass('active');
            $('div[name=course]').addClass('show');
        });
        $('textarea').summernote({
            tabsize: 3,
            height: 500,
            toolbar: [
                ['style', ['style','bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    </script>
@endpush
@push('style')
    <style>
        label{
            font-size: 2rem;
        }
    </style>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">科目學分課程</li>
        <li class="breadcrumb-item text_label"><b>課程影音資料庫</b></li>
    </ol>
@endsection
@section('content')
    <div class="row align-items-stretch">
        <div class="col-12">
            <form class="row" method="POST" action="{{ route("course.store") }}">
                @csrf
                <div class="col-6">
                    <a class="btn btn-primary" href="{{ route('course.index') }}"><i class="fa fa-calendar-plus-o"></i><-返回</a>
                </div>
                <div class="col-6 text-right">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
                <div class="col-12 pt-3">
                    <label for="name">學科名稱：</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <label style="padding-top: 1%" for="message_edit">簡介：</label>
                    <textarea id="message_edit" name="intro"></textarea>
                </div>
            </form>
        </div>
    </div>
@endsection
