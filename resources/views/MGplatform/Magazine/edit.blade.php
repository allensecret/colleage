@extends('MGplatform.layouts.layout')
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
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="p-2"><a href="{{ route('magazineMG.index') }}" class="btn btn-info"> <i class="fas fa-angle-left"></i> 返回 </a> </div>
                <div class="p-2"><h3>期別：{{ $magazineMG->id }}</h3></div>
                <div class="p-2">
                    @can('magazine.update')
                    <a href="{{ route('magazineMG.edit',['magazineMG'=>$magazineMG]) }}" class="btn btn-primary">修改</a>
                    @endcan
                    @can('magazine.delete')
                    <a href="#delete" data-toggle="modal" class="btn btn-danger">刪除</a>
                    @endcan
                </div>
            </div>

            <div class="d-flex flex-column">
                <div class="p-2 flex-fill"><h3>簡介：</h3></div>
                <div class="p-2 flex-fill" style="font-size: 1.2rem">{!! $magazineMG->intro !!}</div>
            </div>

            <div>
                <h3>雜誌預覽<a href="/storage/magazine_file/{{ $magazineMG->file }}"><i class="fas fa-file-pdf"></i></a> </h3>
                <object data="/storage/magazine_file/{{ $magazineMG->file }}" type="application/pdf" style="width: 100%;height: 800px">
                    <embed src="/storage/magazine_file/{{ $magazineMG->file }}" type="application/pdf" />
                </object>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
{{--    @include('MGplatform.Magazine.modals.delete')--}}
@endsection
