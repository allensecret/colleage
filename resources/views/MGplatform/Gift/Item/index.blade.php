@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=gift_li]').addClass('active');
            $('div[name=gift_config]').addClass('show');
        });
    </script>
@endpush
@section('navbar')
    <h3>禮品管理</h3>
@endsection
@section('content')
    <div class="d-flex justify-content-between">
        <div class="p-2"><h3>禮品項目</h3></div>
        <div class="p-2">@can('gift_item.create')<button class="btn btn-primary" data-toggle="modal" data-target="#add">新增</button>@endcan</div>
    </div>
    <div class="d-flex .flex-wrap">
        @foreach($data as $d)
        <div class="p-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $d->name }}</h4>
                    @can('gift_item.update')
                    <a href="#update{{ $d->id }}" data-toggle="modal" class="card-link text-primary">編輯</a>
                    @endcan
                    @can('gift_item.delete')
                    <a href="#delete{{ $d->id }}" data-toggle="modal" class="card-link text-danger">刪除</a>
                    @endcan
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{--<div class="row align-items-stretch">--}}

    {{--</div>--}}
@endsection
@include('MGplatform.Gift.Item.modals.add')
@include('MGplatform.Gift.Item.modals.update')
@include('MGplatform.Gift.Item.modals.delete')
