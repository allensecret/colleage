@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=discussion_li]').addClass('active');
            $('div[name=discussion]').addClass('show');

            $('.announcement_content').summernote({
                tabsize: 3,
                height: 300
            });
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">討論版管理</li>
        <li class="breadcrumb-item"><b>公告管理</b></li>
        <li class="breadcrumb-item text_label"><b>{{ $bulletin->type_name->name }}</b></li>
    </ol>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="p-2">
                            <a href="{{ route('bulletin.index',['id'=>$bulletin->type]) }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>返回</a>
                        </div>
                        <div class="p-2">
                            <h3>{{ $bulletin->title }}</h3>
                        </div>
                        <div class="p-2">
                            @can('bulletin.update')
                            <button class="btn btn-primary" data-target="#edit" data-toggle="modal">修改</button>
                            @endcan
                            @can('bulletin.delete')
                            <button class="btn btn-primary" data-target="#delete" data-toggle="modal">刪除</button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="col-12" style="padding-top: 1rem">
                    {!! $bulletin->content !!}
                    {{--@foreach($bulletin->get_replies as $replies)--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-body">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-8"><h4>學號：{{ $replies->get_student->student_id }}</h4></div>--}}
                                {{--<div class="col-4 text-right"><a href="#delete{{ $replies->id }}" data-toggle="modal" class="card-link" style="color: red"><i class="fas fa-times" ></i>刪除留言</a></div>--}}
                                {{--<div class="col-12">{{ $replies->content }}</div>--}}
                                {{--<div class="col-12 text-right">{{ $replies->created_at }}</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<br>--}}
                    {{--@endforeach--}}
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
{{--@include('MGplatform.Bulletin.modals.delete_relies')--}}
@include('MGplatform.Bulletin.modals.edit')
@include('MGplatform.Bulletin.modals.delete')
