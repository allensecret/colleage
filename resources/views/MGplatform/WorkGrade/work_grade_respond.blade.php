@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=grade_li]').addClass('active');
            $('div[name=grade]').addClass('show');
        });
        $('textarea').summernote({
            tabsize: 3,
            height: 500,
            toolbar: [
                // [groupName, [list of button]]
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
        <li class="breadcrumb-item">成績管理</li>
        <li class="breadcrumb-item text_label"><b>課程作業評分</b></li>
    </ol>
@endsection
@section('content')
    <div class="row align-items-stretch">
        <div class="col-12">
            <form class="row" method="POST" action="{{ route('work_grade.update',['work_grade'=>$work_grade,'level'=>$work_grade->course->level,'curriculum'=>$work_grade->curricula]) }}" >
                @method('PATCH')
                @csrf
                <div class="col-4">
                    <a class="btn btn-primary" href="{{ route('work_grade.index',['level'=>$work_grade->course->level,'curriculum'=>$work_grade->curricula]) }}"><i class="fa fa-calendar-plus-o"></i><-返回</a>
                </div>
                <div class="col-8 text-right">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
                <div class="col-12 pt-3">
                    <div class="d-flex" style="font-size: 1.5rem">
                        <div class="p-2 flex-fill">課程：{{ $work_grade->course->coursedata->title }}</div>
                        <div class="p-2 flex-fill">學號：{{ $work_grade->get_student->account }}</div>
                        <div class="p-2 flex-fill form-inline">評分：
                            <select class="form-control" id="score" name="score" style="float: left">
                                <option value="A" {{ $work_grade->grade == "A"?"selected":"" }}>A</option>
                                <option value="B" {{ $work_grade->grade == "B"?"selected":"" }}>B</option>
                                <option value="C" {{ $work_grade->grade == "C"?"selected":"" }}>C</option>
                                <option value="D" {{ $work_grade->grade == "D"?"selected":"" }}>D</option>
                                <option value="E" {{ $work_grade->grade == "E"?"selected":"" }}>E</option>
                            </select>
                        </div>
                        <div class="p-2 flex-fill">報告內容：<a href="#demo" class="btn" data-toggle="collapse"><i class="fas fa-file-alt" style="color: green;font-size: 1.2rem"></i></a></div>
                    </div>

                    <div id="demo" class="collapse">
                        <div class="card">
                            <div class="card-body">{!! $work_grade->content !!}</div>
                        </div>

                    </div>
                    <h2 class="pt-3">回應：</h2>
                    <textarea id="message_edit" name="respond">{!! $work_grade->respond !!}</textarea>
                </div>
            </form>
        </div>
    </div>
@endsection


