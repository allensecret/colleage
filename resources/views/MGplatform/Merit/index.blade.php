@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=merit_li]').addClass('active');
            $('div[name=merit]').addClass('show');

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });
    </script>
@endpush
@push('style')
    <style>
        .card{
            margin-top: 1%;
        }
        .card-header{
            font-size: 2rem;
        }

        .custom-file-input:lang(en) ~ .custom-file-label::after {
            content: "檔案";
        }
    </style>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">功過格</li>
        <li class="breadcrumb-item text_label"><b>項目</b></li>
    </ol>
@endsection
@section('content')
    <div class="row align-items-stretch">
        <div class="col-12">
            <div class="row">
                @can('merit.create')
                    <div class="col-12">
                        <a class="btn btn-primary" href="#myModal" data-toggle="modal"><i class="fa fa-calendar-plus-o"></i>新增項目</a>
                    </div>
                @endcan
                <div class="col-12 pt-3">
                    @foreach($data as $d)
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">

                                <div class="p-2">@can('merit.update')<a href="#edit{{ $d->id }}" data-toggle="modal"><i class="fas fa-edit" style="color: #1d68a7"></i></a> @endcan</div>
                                <div class="p-2">{{ $d->name }}</div>
                                <div class="p-2">@can('merit.delete')<a href="#delete{{ $d->id }}" data-toggle="modal"><i class="fas fa-trash-alt" style="color: #ef0d0c"></i></a> @endcan</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@include('MGplatform.Merit.modals.add')
@include('MGplatform.Merit.modals.edit')
@include('MGplatform.Merit.modals.delete')
