@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=edit_li]').addClass('active');
            $('div[name=edit]').addClass('show');

            $('#message_classification').summernote({
                tabsize: 3,
                height: 200
            });
            $('#message_precautions').summernote({
                tabsize: 3,
                height: 200
            });
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">頁面編輯</li>
        <li class="breadcrumb-item text_label"><b>說明看板</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <form class="row pb-3" action="{{ route('edit_description_save',['type'=>'classification']) }}" method="post">
                <div class="col-8"><h3>分類說明</h3></div>
                <div class="col-4 text-right"><button class="btn btn-primary" type="submit">保存</button></div>
                <div class="col-12">
                    <textarea id="message_classification" name="content">{{ $classification->content ?? "" }}</textarea>
                </div>
                {{ csrf_field() }}
            </form>
            <form class="row" action="{{ route('edit_description_save',['type'=>'precautions']) }}" method="post">
                <div class="col-8"><h3>注意事項</h3></div>
                <div class="col-4 text-right"><button class="btn btn-primary" type="submit">保存</button></div>
                <div class="col-12">
                    <textarea id="message_precautions" name="content">{{ $precautions->content ?? "" }}</textarea>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
