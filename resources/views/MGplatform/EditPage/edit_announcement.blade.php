@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=edit_li]').addClass('active');
            $('div[name=edit]').addClass('show');

            $('textarea').summernote({
                tabsize: 3,
                height: 600
            });
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">頁面編輯</li>
        <li class="breadcrumb-item text_label"><b>重要通知</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="alert {{ $config->config == 1 ? "alert-success":"alert-danger" }}">
            <strong>通知開啟狀態!</strong> [{{ $config->config == 1 ? "開啟":"關閉" }}]
        </div>
        <form class="container-fluid" action="{{ route('edit_announcement_save',['type'=>'announcement']) }}" method="post">
            <div class="row">
                <div class="col-8">
                    <h2>重要通知</h2>
                </div>
                <div class="col-4 text-right">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> 保存</button>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i> 管理</button>
                </div>
                <div class="col-12 pt-3">
                    <textarea id="message_edit" name="content">{{ $data->content ?? "" }}</textarea>
                </div>
                {{ csrf_field() }}
            </div>
        </form>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
@include('MGplatform.EditPage.modals.edit_announcement_mange')
