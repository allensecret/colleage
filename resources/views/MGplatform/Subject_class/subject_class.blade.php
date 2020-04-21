@extends('MGplatform.layouts.layout')
@push('script')
<script>
    $(document).ready(function () {
        $('li[name=course_li]').addClass('active');
        $('div[name=course]').addClass('show');

        // $('.nav-item a').click(function () {
        //     var arr = $(this).attr('href').split('-');
        //     $('#create_form').attr('action','/admin/Class/subject_class/create/'+arr[1]);
        // });
    });
</script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">科目學分課程</li>
        <li class="breadcrumb-item active"><b>科目學分編輯</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        @foreach($level as $v)
                        <li class="nav-item">
                            <a class="nav-link {{ $v->id == $id ?"active":"" }}"  href="{{ route('subject_class.index',['class'=>$v->id]) }}">{{ $v->level }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 pt-4" >
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h3>
                        <div class="row">
                            <div class="col-6">{{ $data->level }}</div>
                            <div class="col-6 text-right">
                                @can('subject_class.create')
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                    <i class="fa fa-calendar-plus-o"></i> 新增課程
                                </button>
                                @endcan
                            </div>
                        </div>
                    </h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>管理</th>
                            <th>課程編號</th>
                            <th>課程名稱</th>
                            <th>修別</th>
                            <th>授課老師</th>
                            <th>提交報告</th>
                            <th style="width: 30%">備註</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data->curricula->where('level',$id) as $l)
                            <tr>
                                <td>
                                    @can('subject_class.delete')
                                    <a href="#delete{{ $l->id }}" data-toggle="modal" style="color: red;font-size: 1.3rem"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;&nbsp;
                                    @endcan
                                    @can('subject_class.update')
                                    <a href="#modify{{ $l->id }}" data-toggle="modal" style="color: blue;font-size: 1.3rem"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                                    @endcan
                                </td>
                                <td>{{ $l->coursedata->sn }}</td>
                                <td>{{ $l->coursedata->title }}</td>
                                <td>{{ $l->compulsory == 1?"必修":"選修" }}</td>
                                <td>{{ $l->coursedata->teacher }}</td>
                                <td style="text-align: center">{!! $l->report == 0 ?"<i class='fas fa-times' style='font-size: 1.3rem;color: red'>": "<i class='fa fa-check' style='font-size: 1.3rem;color: green'></i>" !!}</td>
                                <td>{{ $l->remark }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
    </div>
@endsection
@include('MGplatform.Subject_class.modals.subject_class_add')
@include('MGplatform.Subject_class.modals.subject_class_modify')
@include('MGplatform.Subject_class.modals.subject_class_delete')
