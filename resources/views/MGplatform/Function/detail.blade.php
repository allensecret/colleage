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
                    <h3><a href="{{ route('features.index') }}"><</a> {{ $feature->name }}</h3>
                </div>
                <div class="col-12 col-sm-8 text-right">
                    <a href="#create" data-toggle="modal" class="btn btn-primary"><i class="fas fa-plus"></i>新增項目</a>
                </div>
                <div class="col-12" style="padding-top: 1rem">
                    <div class="d-flex justify-content-start flex-wrap">
                        @foreach($feature->item as $i)
                            <div class="p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $i->item }}</h4>
                                        <p class="card-text">
                                            @foreach(array_filter(mb_split(";",$i->option)) as $s)
                                                <button class="btn btn-primary">{{ $s }}</button>
                                            @endforeach
                                        </p>
                                        <a href="#edit_{{ $i->id }}" data-toggle="modal" class="card-link">修改</a>
                                        <a href="#delete_{{ $i->id }}" data-toggle="modal" class="card-link">刪除</a>
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
    @include('MGplatform.Function.modals.create_item')
    @include('MGplatform.Function.modals.edit_item')
    @include('MGplatform.Function.modals.delete_item')
@endsection

