@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=grade_li]').addClass('active');
            $('div[name=grade]').addClass('show');

            $("#level").change(function () {
                $('#curricula').val("");
                $("#term_form").submit();
            });

            $("#curricula").change(function () {
                $("#term_form").submit();
            });

            $("#level").children().each(function(){
                if ($(this).val() == "{{ $_GET['level'] }}"){
                    $(this).attr("selected", true);
                }
            });

            $('#curricula').children().each(function () {
                if($(this).val() == "{{ $_GET['curricula'] }}"){
                    $(this).attr("selected", true);
                }
            });
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">成績管理</li>
        <li class="breadcrumb-item">課程作業評分</li>
        <li class="breadcrumb-item text-label"><b>未遞交作業</b></li>
    </ol>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <a href="{{ route('work_grade.index',['level'=>$s_level,'curriculum'=>$s_curricula]) }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>返回</a>
                    @can('work_grade.update')
                    <button class="btn btn-warning" data-toggle="modal" data-target="#unreport_notice" ><i class="fas fa-envelope"></i>全部通知</button>
                    @endcan
                </div>
                <div class="col-8">
                    <form class="form-inline float-right" action="{{ route('UnReport.index') }}" id="term_form" name="term_form">
                        <label for="class">選擇年級：</label>
                        <select class="form-control" id="level" name="level">
                            @foreach($level as $l)
                                <option value="{{ $l->id }}">{{ $l->level }}</option>
                            @endforeach
                        </select>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="course">選擇課程：</label>
                        <select class="form-control" id="curricula" name="curricula">
                            <option value="">請選擇課程</option>
                            @foreach($curricula as $c)
                                <option value="{{ $c->id }}">{{ $c->coursedata->sn." ".$c->coursedata->title }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="col-12" style="padding-top: 1rem">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>學號</th>
                            <th>姓名</th>
                            <th>通知</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($data))
                            @foreach($data as $v)
                                <tr>
                                    <td>{{ $v->get_student->account }}</td>
                                    <td>{{ $v->get_student->name }}</td>
                                    <td>
                                        @can('work_grade.update')
                                            <button class="btn" data-toggle="modal" data-target="#personal{{ $v->student }}"><i class="fas fa-envelope" style="color:red"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
@if(!empty($data))
    @include('MGplatform.WorkGrade.modals.grade_unreport_notice')
    @include('MGplatform.WorkGrade.modals.grade_unreport_notice_personal')
@endif
