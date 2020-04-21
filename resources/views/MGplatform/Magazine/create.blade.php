@extends('MGplatform.layouts.layout')
@push('style')
    <style>
        .custom-file-input:lang(en) ~ .custom-file-label::after {
            content: "檔案";
        }

        /*.custom-file{*/
            /*width: 80%;*/
        /*}*/
    </style>
@endpush
@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=magazine_li]').addClass('active');

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            $('#comment').summernote({
                tabsize: 3,
                height: 400
            });
        });
    </script>
@endpush
@section('navbar')
    <h3>雜誌管理</h3>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <form action="{{ route('magazineMG.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="p-1">
                            <a href="{{ route('magazineMG.index') }}" class="btn btn-primary">返回</a>
                        </div>
                        <div class="p-1">
                            <h1>新增雜誌</h1>
                        </div>
                        <div class="p-1">
                            <button type="submit" class="btn btn-success btn-lg">新增</button>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12 col-md-4 col-lg-2 col-xl-2">
                        <h3>年度:</h3>
                        <select name="year" class="custom-select">
                            @for($i=date('Y');$i>=2019;$i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <div style="color: red">{{ $errors->first('year') }}</div>
                    </div>

                    <div class="form-group col-12 col-md-4 col-lg-2 col-xl-2">
                        <h3>期別:</h3>
                        <div class="form-group">
                            <input type="number" class="form-control" id="id" name="id">
                        </div>
                        <div style="color: red">{{ $errors->first('id') }}</div>
                    </div>

                    <div class="form-group col-12 col-md-4 col-lg-2 col-xl-2">
                        <h3>雜誌檔案(繁)</h3>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="magazineFile" name="file">
                            <label class="custom-file-label" for="magazineFile"></label>
                        </div>
                        <div style="color: red">{{ $errors->first('file') }}</div>
                    </div>

                    <div class="form-group col-12 col-md-4 col-lg-2 col-xl-2">
                        <h3>雜誌檔案(簡)</h3>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="magazine_bg_File" name="gb_file">
                            <label class="custom-file-label" for="magazine_bg_File"></label>
                        </div>
                        <div style="color: red">{{ $errors->first('gb_file') }}</div>
                    </div>

                    <div class="form-group col-12 col-md-4 col-lg-2 col-xl-2">
                        <h3>圖片</h3>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imageFile" name="image">
                            <label class="custom-file-label" for="imageFile"></label>
                        </div>
                        <div style="color: red">{{ $errors->first('image') }}</div>
                    </div>

                    <div class="form-group col-12 col-md-4 col-lg-2 col-xl-2">
                        <h3>大圖片</h3>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imageBFile" name="image_b">
                            <label class="custom-file-label" for="imageBFile"></label>
                        </div>
                        <div style="color: red">{{ $errors->first('image_b') }}</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="comment" style="font-size: 1.75rem">簡介:</label>
                    <textarea class="form-control" rows="5" id="comment" name="intro"></textarea>
                </div>
                <div style="color: red">{{ $errors->first('intro') }}</div>
            </form>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
