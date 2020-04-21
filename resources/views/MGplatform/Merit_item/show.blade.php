@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=merit_li]').addClass('active');
            $('div[name=merit]').addClass('show');

            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myList li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endpush
@push('style')
    <style>
        a:hover{
            text-decoration:none;
        }

        .list-group-item{
            background-color: rgba(255,255,255,0.01);
        }

        .fa-trash-alt{
            color: #ef0d0c;
        }
        h4{
            margin-top: 20px;
            margin-bottom: 20px;
            /*border-bottom: black solid 1px;*/
        }
    </style>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">功過格</li>
        <li class="breadcrumb-item text_label"><b>課題</b></li>
    </ol>
@endsection
@section('content')
    <div class="row align-items-stretch">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <div class="p-2"><a href="{{ route('merit_item_MG.index') }}" class="btn btn-info">< 返回</a></div>
                <div class="p-2"><h2>{{ $data->name }}</h2></div>
                <div class="p-2">
                    @can('merit_item.create')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_group">新增群組</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">新增</button>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-12">
            <input class="form-control" id="myInput" type="text" placeholder="搜尋..">
        </div>
        <div class="col-12 mt-3">
            @if(count($list_group) > 0)
                @foreach($list_group as $l)
                    <h4>{{ $l->name }}</h4>
                    <ul class="list-group list-group-flush" id="myList">
                        @foreach($l->item as $i)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div class="p-2">
                                        @can('merit_item.update')
                                        <a href="#edit{{ $i->id }}" data-toggle="modal">{{ $i->item }}</a>
                                        @endcan
                                    </div>
                                    <div class="p-2">
                                        @can('merit_item.delete')
                                        <a href="#delete{{ $i->id }}" data-toggle="modal"><i class="fas fa-trash-alt"></i></a>
                                        @endcan
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            @else
                <ul class="list-group list-group-flush" id="myList">
                    @foreach($data->item_data->where('student','') as $i)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div class="p-2">
                                    <a href="#edit{{ $i->id }}" data-toggle="modal">{{ $i->item }}</a>
                                </div>
                                <div class="p-2">
                                    <a href="#delete{{ $i->id }}" data-toggle="modal"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
@include('MGplatform.Merit_item.modals.add')
@include('MGplatform.Merit_item.modals.edit')
@include('MGplatform.Merit_item.modals.delete')
@include('MGplatform.Merit_item.modals.add_group')
