@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=management_li]').addClass('active');
            $('div[name=management]').addClass('show');

        });
    </script>

@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">網路系統管理</li>
        <li class="breadcrumb-item text_label"><b>角色權限</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <h3>角色權限</h3>
                </div>
                <div class="col-12 col-sm-8 text-right">
                    @can('role.create')
                    <a href="{{ route('role.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>新增角色與權限</a>
                    @endcan
                </div>
                <div class="col-12" style="padding-top: 1rem">
                    <div class="card-columns">
                        @foreach($data as $v)
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $v->class }}</h4>
                                    @can('role.update')
                                    <a href="{{ route('role.edit',['role'=>$v]) }}" class="btn btn-warning">編輯</a>
                                    @endcan
                                    @can('role.delete')
                                    <a href="#delete{{ $v->id }}" data-toggle="modal" class="btn btn-danger">刪除</a>
                                    @endcan
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
@include('MGplatform.Role.modals.delete')
