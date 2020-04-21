@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=edit_li]').addClass('active');
            $('div[name=edit]').addClass('show');
        });
    </script>
@endpush

@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">頁面編輯</li>
        <li class="breadcrumb-item"><b>導師介紹</b></li>
        <li class="breadcrumb-item text_label">介紹內容</li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="p-2">
                            <h2>介紹內容</h2>
                        </div>
                        <div class="p-2">
                            <a href="{{ route('teacher_introduction.index') }}" class="btn btn-primary">返回</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 pt-3">
                    <div class="d-flex justify-content-around">
                        <div class="p-2 flex-fill">
                            <div class="d-flex justify-content-center">
                                <div class="p-2"><img src="{{ asset('storage/img/'.$teacher->img) }}" style="width: 100%;height: 100%"></div>
                            </div>
                            <div class="d-flex mt-5 justify-content-around">
                                @for($i = 0;$i<count(json_decode($teacher->attr));$i++)
                                    <div class="p-2"><a href="{{ json_decode($teacher->attr)[$i] }}">{{ json_decode($teacher->attr)[$i] }}</a></div>
                                @endfor
                            </div>
                        </div>
                        <div class="p-2 flex-fill">
                            <div style="border:#000000 5px solid;">{!! $teacher->introduction !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
