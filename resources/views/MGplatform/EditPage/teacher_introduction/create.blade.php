@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=edit_li]').addClass('active');
            $('div[name=edit]').addClass('show');

            $('#message_edit').summernote({
                tabsize: 3,
                height: 250
            });
            $('#add-attr').click(function () {
                var number = $("#attr-content>.p-2").length +1;
                // alert($("#attr-content>.p-2").length);
                $('#attr-content').append("<div class='p-2 flex-fill'><div class='form-group'><label for='email'>"+number+".</label><input type='text' class='form-control' id='attr' name='attr[]'></div></div>");
            });
        });
    </script>
@endpush

@push('style')
    <style>
        label{
            font-size: 1.2em;
        }
    </style>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">頁面編輯</li>
        <li class="breadcrumb-item"><b>導師介紹</b></li>
        <li class="breadcrumb-item text_label">新增導師</li>
    </ol>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="p-2">
                            <h2>新增導師</h2>
                        </div>
                        <div class="p-2">
                            <a href="{{ route('teacher_introduction.index') }}" class="btn btn-primary">返回</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 pt-3">
                    <form action="{{ route('teacher_introduction.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex">
                            <div class="p-2 flex-fill">
                                <div class="form-group">
                                    <label for="email">導師名稱:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    <div style="color: red">{{ $errors->first('name') }}</div>
                                </div>
                            </div>
                            <div class="p-2 flex-fill">
                                <div class="form-group">
                                    <label for="pwd">導師個人照片:</label>
                                    <input type="file" class="form-control-file border" id="img" name="img" style="background-color: white;border-radius: 10px;line-height: 2em">
                                    <div style="color: red">{{ $errors->first('img') }}</div>
                                </div>
                            </div>
                        </div>
                        <label for="email"><a class="btn btn-success" id="add-attr"><i class="fas fa-plus" style="color: white"></i></a>  連結:</label>
                        <div class="d-flex" id="attr-content">
                            <div class="p-2 flex-fill">
                                <div class="form-group">
                                    <label for="email">1.</label>
                                    <input type="text" class="form-control" id="attr" name="attr[]">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="p-2 flex-fill">
                                <div class="form-group">
                                    <label for="message_edit">簡介：</label>
                                    <textarea id="message_edit" name="introduction"></textarea>
                                </div>
                                <div style="color: red">{{ $errors->first('introduction') }}</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="p-2">
                                <button type="submit" class="btn btn-primary">送出</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
