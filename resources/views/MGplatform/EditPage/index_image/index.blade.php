@extends('MGplatform.layouts.layout')

@push('style')
    <style>
        img{
            width: 100%;
            border: black solid 1px;
            border-radius: 10px;
            margin-bottom: 5px;
        }

        .p-2{
            /*border: black solid 1px;*/
            text-align: right;
        }

        .custom-file-input:lang(en) ~ .custom-file-label::after {
            content: "檔案";
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=edit_li]').addClass('active');
            $('div[name=edit]').addClass('show');

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">頁面編輯</li>
        <li class="breadcrumb-item text_label"><b>首頁輪播圖片</b></li>
    </ol>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            @include('MGplatform.layouts.alert')
            <div class="row">
                <div class="col-8">
                    <h2>圖片</h2>
                </div>
                <div class="col-4">
                    @can('edit_index_image.create')
                        <a href="#create" data-toggle="modal" class="btn btn-primary" style="float: right"> 新增圖片</a>
                    @endcan
                </div>
                <div class="col-12 pt-3">
                    <div class="d-flex flex-column">
                        @foreach($data as $d)
                            <div class="p-2 mb-3">
                                <img src="{{ asset('storage/index_img/'.$d->img) }}" alt="">
                                @can('edit_index_image.update')
                                <a href="#update{{ $d->id }}" data-toggle="modal" class="btn btn-primary">修改</a>
                                @endcan
                                @can('edit_index_image.delete')
                                <a href="#delete{{ $d->id }}" data-toggle="modal" class="btn btn-danger">刪除</a>
                                @endcan
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
    @include('MGplatform.EditPage.index_image.modals.create')
    @include('MGplatform.EditPage.index_image.modals.update')
    @include('MGplatform.EditPage.index_image.modals.delete')
@endsection
