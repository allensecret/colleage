@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=grade_li]').addClass('active');
            $('div[name=grade]').addClass('show');
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">成績管理</li>
        <li class="breadcrumb-item text_label"><b>學生個人成績查詢</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-xl-4">
                    <form class="form-inline" action="{{ route('students_grade.index') }}" id="term">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="查詢學號....." value="{{ old('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-xl-8">
                    <div class="d-flex" style="font-size: 1.2rem">
                        <div class="p-2 bg-warning flex-fill">班級：<font color="white">{{ $data->data->level->level ?? "" }}</font></div>
                        <div class="p-2 bg-warning flex-fill">學號：<font color="white">{{ $data->account ?? "" }}</font></div>
                        <div class="p-2 bg-warning flex-fill">姓名：<font color="white">{{ $data->name ?? "" }}</font></div>
                    </div>
                </div>
                <div class="col-12 pt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>課程編號</th>
                                <th>標題</th>
                                <th>種類</th>
                                <th>成績</th>
                                <th>報告內容</th>
                                <th>評分</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($data))
                            @foreach($data->curriculas as $c)
                                @if($c->course->level == $data->data->course_level && $c->course->report == 1)
                                    <tr>
                                        <td>{{ $c->course->coursedata->sn }}</td>
                                        <td>{{ $c->course->coursedata->title }}</td>
                                        <td>{{ $c->course->compulsory == 1 ? "必修":"選修" }}</td>
                                        <td>{{ empty($c->grade) ? "未評":$c->grade }}</td>
                                        <td>
                                            @if($c->done != 0)
                                                <button class="btn" data-toggle="modal" data-target="#work_report{{ $c->id }}"><i class="fas fa-file-alt" style="color: green"></i></button>
                                            @endif
                                        </td>
                                        <td>
                                            @if($c->done != 0)
                                                @can('students_grade.update')
                                                <a href="{{ route('students_grade.edit',['students_grade'=> $c]) }}"><i class="fas fa-file-signature"></i></a>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-12 pt-3">
                    <h4 style="text-align: center"><b>歷史成績</b></h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>課程編號</th>
                                <th>標題</th>
                                <th>種類</th>
                                <th>成績</th>
                                <th>報告內容</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($data))
                            @foreach($data->curriculas as $c)
                                @if($c->course->level != $data->data->course_level && $c->course->report == 1)
                                    <tr>
                                        <td>{{ $c->course->coursedata->sn }}</td>
                                        <td>{{ $c->course->coursedata->title }}</td>
                                        <td>{{ $c->course->compulsory == 1 ? "必修":"選修" }}</td>
                                        <td>{{ $c->grade == "" ? "未評":$c->grade }}</td>
                                        <td>
                                            <button class="btn" data-toggle="modal" data-target="#work_report{{ $c->id }}"><i class="fas fa-file-alt" style="color: green"></i></button>
                                        </td>
                                    </tr>
                                @endif
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
    @include('MGplatform.StudentGrade.modals.students_grade_report')
@endif
