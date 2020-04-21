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
        <li class="breadcrumb-item text_label"><b>帳號管理</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <h3>帳號管理</h3>
                </div>
                <div class="col-4 text-right">
                    @can('account.create')
                    <button class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i>新增帳號</button>
                    @endcan
                </div>
                <div class="col-12 pt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>管理</th>
                                <th>角色</th>
                                <th>名稱</th>
                                <th>帳號</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $v)
                            <tr>
                                <td>
                                    @can('account.delete')
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#delete_{{ $v->id }}"><i class="fas fa-trash"></i></button>
                                    @endcan
                                    @can('account.update')
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#edit_{{ $v->id }}"><i class="fas fa-edit"></i></button>
                                    @endcan
                                </td>
                                <td>{{ $v->role_name->class }}</td>
                                <td>{{ $v->name }}</td>
                                <td>{{ $v->account }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
@include('MGplatform.Adminstration.modals.admin_account_add')
@include('MGplatform.Adminstration.modals.admin_account_edit')
@include('MGplatform.Adminstration.modals.admin_account_delete')
