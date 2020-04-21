@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=download_li]').addClass('active');
            $('div[name=download]').addClass('show');
        });
    </script>

@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">資源檔案管理</li>
        <li class="breadcrumb-item text_label"><b>教材區</b></li>
    </ol>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <h3>教材區</h3>
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 text-right">
                    @can('teaching_material.create')
                    <button class="btn btn-primary" data-toggle="modal" data-target="#add_resource"><i class="fas fa-plus"></i>新增檔案資源</button>
                    @endcan
                </div>
                <div class="col-12 pt-3">
                    <ul class="nav nav-pills nav-justified">
                        @foreach($level as $l)
                            <li class="nav-item">
                                <a class="nav-link {{ $l->id == $type ? "active":"" }}" href="{{ route('teaching_material.index',['type'=>$l->id]) }}">{{ $l->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="col-12 pt-3">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 20%">管理</th>
                                <th>標題</th>
                                <th>檔案</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($resources as $r)
                                <tr>
                                    <td>
                                        @can('teaching_material.delete')
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_resource{{ $r->id }}"><i class="fas fa-trash"></i></button>
                                        @endcan
                                        @can('teaching_material.update')
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_resource{{ $r->id }}"><i class="fas fa-edit"></i></button>
                                        @endcan
                                    </td>
                                    <td>{{ $r->name }}</td>
                                    <td>
                                        <a href="{{ $r->attr }}"><i class="fas fa-file-download"></i>{{ $r->attr }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
@include('MGplatform.File.modals.file_teaching_material_add')
@include('MGplatform.File.modals.file_teaching_material_edit')
@include('MGplatform.File.modals.file_teaching_material_delete')
