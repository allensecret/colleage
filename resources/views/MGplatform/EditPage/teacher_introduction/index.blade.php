@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=edit_li]').addClass('active');
            $('div[name=edit]').addClass('show');
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">頁面編輯</li>
        <li class="breadcrumb-item text_label"><b>導師介紹</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <h2>導師介紹</h2>
                </div>
                <div class="col-4">
                    @can('edit_teacher.create')
                        <a href="{{ route('teacher_introduction.create') }}" class="btn btn-primary" style="float: right"> 新增導師</a>
                    @endcan
                </div>
                <div class="col-12 pt-3">
                    <div class="card-columns">
                        @foreach($teacher as $v)
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6"><img src="{{ asset('storage/img/'.$v->img) }}" style="width: 100%;height: 100%"></div>
                                        <div class="col-6 d-flex flex-column">
                                            <div class="p-2 text-center"><a href="{{ route('teacher_introduction.show',['teacher_introduction'=>$v]) }}"><h4>{{ $v->name }}</h4></a></div>
                                            <div class="p-2 flex-grow-1 d-flex align-items-end justify-content-between">
                                                <div class="p-2">
                                                    @can('edit_teacher.update')
                                                    <a href="{{ route('teacher_introduction.edit',['teacher_introduction'=>$v]) }}" class="btn btn-warning"> 修改</a>
                                                    @endcan
                                                </div>
                                                <div class="p-2">
                                                    @can('edit_teacher.delete')
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $v->id }}"> 刪除</button>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
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
    @include('MGplatform.EditPage.teacher_introduction.modals.confirm_delete')
@endsection
