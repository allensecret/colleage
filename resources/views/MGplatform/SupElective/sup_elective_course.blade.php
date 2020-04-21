@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=course_li]').addClass('active');
            $('div[name=course]').addClass('show');
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">科目學分課程</li>
        <li class="breadcrumb-item text_label"><b>選課管理及輔助選課</b></li>
    </ol>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="alert {{ $config->config == 1 ? "alert-success":"alert-danger" }}">
            <strong>開放選課狀態!</strong> [ {{ $config->config == 1 ? "開啟":"關閉" }} ]
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <form class="form-inline" action="{{ route('sup_elective.index') }}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search" placeholder="查詢學號.....">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </form>
                </div>
                <div class="col-4">
                    @can('sup_elective.update')
                    <button class="btn btn-info" data-toggle="modal" data-target="#auto_elective_course" style="float: right">選課開放管理</button>
                    @endcan
                </div>
                <div class="col-12">
                    <div class="d-flex text-center" style="">
                        <div class="p-2 bg-warning flex-fill">班級：{{ $data->data->level->level ?? "" }}</div>
                        <div class="p-2 bg-warning flex-fill">學號：{{ $data->account ?? "" }}</div>
                        <div class="p-2 bg-warning flex-fill">姓名：{{ $data->name ?? "" }}</div>
                    </div>
                    <h3 style="text-align: center;padding-top: 1%">已選的課程</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>管理</th>
                                <th>課程編號</th>
                                <th>標題</th>
                                <th>修別</th>
                                <th>授課老師</th>
                                <th>備註</th>
                            </tr>
                        </thead>
                        <tbody class="table-primary">
                        @if(!empty($data))
                            @foreach($data->curriculas as $v)
                                @if($v->course->level == $data->data->course_level)
                                    <tr>
                                        <td>
                                            @can('sup_elective.create')
                                            <button class="btn" data-toggle="modal" data-target="#ck_remove{{ $v->id }}"><i class="fas fa-minus" style="color: red"></i></button>
                                            @endcan
                                        </td>
                                        <td>{{ $v->course->coursedata->sn }}</td>
                                        <td>{{ $v->course->coursedata->title }}</td>
                                        <td style="color: {{ $v->course->compulsory == 1 ? "red":"green"}}">{{ $v->course->compulsory == 1 ? "必修":"選修" }}</td>
                                        <td>{{ $v->course->coursedata->teacher }}</td>
                                        <td>{{ $v->course->remark }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <h3 style="text-align: center">可加選的選修課程</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>加選</th>
                                <th>課程編號</th>
                                <th>標題</th>
                                <th>修別</th>
                                <th>授課老師</th>
                                <th>備註</th>
                            </tr>
                        </thead>
                        <tbody class="table-danger">
                        @if(!empty($data))
                            @foreach($data->data->level->curricula()->whereNotIn('id',$data->curriculas()->pluck('curricula'))->get() as $v)
                                <tr>
                                    <td>
                                        @can('sup_elective.create')
                                        <button class="btn" data-toggle="modal" data-target="#ck_add{{ $v->id }}"><i class="fas fa-plus" style="color: green"></i></button>
                                        @endcan
                                    </td>
                                    <td>{{ $v->coursedata->sn }}</td>
                                    <td>{{ $v->coursedata->title }}</td>
                                    <td style="color: {{ $v->compulsory == 1 ? "red":"green"}}">{{ $v->compulsory == 1 ? "必修":"選修" }}</td>
                                    <td>{{ $v->coursedata->teacher }}</td>
                                    <td>{{ $v->remark }}</td>
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
@include('MGplatform.SupElective.modals.sup_elective_course_management')
@include('MGplatform.SupElective.modals.sup_elective_course_ck_add')
@include('MGplatform.SupElective.modals.sup_elective_course_ck_remove')
