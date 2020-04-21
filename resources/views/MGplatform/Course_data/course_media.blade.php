@extends('MGplatform.layouts.layout')
@push('script')
<script>
    $(document).ready(function() {
        $('li[name=course_li]').addClass('active');
        $('div[name=course]').addClass('show');

        $('#host').children().each(function () {
            if($(this).val() == "{{ isset($_GET['host'])?$_GET['host']:1 }}"){
                $(this).attr("selected","true");
            }
        });

        $("#host").change(function () {
            $("#host_form").submit();
        });
    });
</script>
@endpush
@push('style')
    <style>
        .pagination {
            padding-top: 1%;
            justify-content: center;
        }
    </style>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">科目學分課程</li>
        <li class="breadcrumb-item active"><b>課程影音資料庫</b></li>
    </ol>
@endsection
@section('content')

    <div class="row align-items-stretch">
        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    <a href='{{ route('course_data.index') }}' class='btn btn-info'><i class="fas fa-arrow-left"></i> 返回</a>
                </div>
                <div class="col-8">
                    <form class="form-inline" action="{{ route('course_data.show',['course_datum'=> $course_datum]) }}" id="host_form" style="float: right">
                        <label for="host">主機：</label>
                        <select class="form-control" id="host" name="host">
                            <option value="1">台灣</option>
                            <option value="3">香港</option>
                            <option value="2">江蘇</option>
                            <option value="4">德國</option>
                        </select>
                    </form>
                </div>
                <div class="col-12">
                    @foreach($data->chunk(3) as $chunk)
                    <div class="row">
                        @foreach($chunk as $v)
                        <div class="col-4" style="padding-bottom: 1%">
                            <div class="card" style="width:100%">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $v->data->title }} ep.{{ $v->ep }}  <a href="#" data-toggle="modal" data-target="#text{{ $v->id }}"><i class="fas fa-file-alt"></i>文字稿</a></h5>
                                </div>
                                @if(substr($v->attr,-3) == "mp3")
                                    <audio width="100%" controls="controls">
                                        <source src="https:{{ $host->attr.$v->attr }}" type="audio/mp3">
                                    </audio>
                                @else
                                    <video width="100%" controls="controls">
                                        <source src="https:{{ $host->attr.$v->attr }}" type="video/mp4">
                                    </video>
                                @endif

                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                    {{ $data->appends(['host' => isset($_GET['host']) ? $_GET['host']:1])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@include('MGplatform.Course_data.modals.course_media_text')

