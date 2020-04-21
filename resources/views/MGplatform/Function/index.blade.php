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
        <li class="breadcrumb-item text_label"><b>功能編輯</b></li>
    </ol>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <h3>功能編輯</h3>
                </div>
                <div class="col-12 col-sm-8 text-right">
                    <a href="#create" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i>新增項目</a>
                </div>
                <div class="col-12" style="padding-top: 1rem">
                    <div class="d-flex justify-content-start flex-wrap">
                        @foreach($data as $d)
                        <div class="p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><a href="{{ route('features.show',['features'=>$d]) }}">{{ $d->name }}</a></h4>
                                    <button data-toggle="modal" data-target="#edit_{{ $d->id }}" class="btn btn-primary">修改</button>
                                    <button data-toggle="modal" data-target="#delete_{{ $d->id }}" class="btn btn-danger">刪除</button>
                                </div>
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
@include('MGplatform.Function.modals.create')
@include('MGplatform.Function.modals.edit')
@include('MGplatform.Function.modals.delete')
