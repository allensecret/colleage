@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=discussion_li]').addClass('active');

        });
    </script>
@endpush
@push('style')

@endpush

@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item ">
            留言板管理
        </li>
        <li class="breadcrumb-item text_label">
            {{ $discussionMG->title }}
        </li>
    </ol>
@endsection
@section('content')
    <div class="row align-items-stretch">
        <div class="col-6 text-left">
            <a href="{{ url()->previous() }}" class="btn btn-primary" style="font-size: 1.3rem">
                <i class="fas fa-angle-left"></i>返回
            </a>
        </div>
        <div class="col-6 text-right">
            @can('discussion.delete')
            <a href="#delete" data-toggle="modal" class="btn btn-danger"><i class="fas fa-trash"></i></a>
            @endcan
        </div>
        <div class="col-12 pt-3" style="font-size: 1.2rem">
            <div class="d-flex flex-column">
                <div class="p-2">主題：{{ $discussionMG->title }}</div>
                <div class="p-2" style="border-bottom: black 1px solid">內容：{!! $discussionMG->content !!}</div>
                @foreach($discussionMG->replies as $r)
                    <div class="p-2">
                        <div class="d-flex justify-content-between">
                            <div class="p-2">
                                回復者：{{ $r->get_student_name->account }}
                            </div>
                            <div class="p-2">
                                <a href="#delete_replies" data-toggle="modal" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="p-2" style="border-bottom: black 1px solid">內容：{!! $r->content !!}</div>
                @endforeach
            </div>

        </div>
    </div>
    @include('MGplatform.Discussion.modals.delete')
    @include('MGplatform.Discussion.modals.delete_replies')
@endsection
