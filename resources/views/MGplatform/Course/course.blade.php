@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=course_li]').addClass('active');
            $('div[name=course]').addClass('show');
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
    </style>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">科目學分課程</li>
        <li class="breadcrumb-item text_label"><b>學科類別</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="row align-items-stretch">
        <div class="col-12">
            <div class="row">
                @can('course.create')
                <div class="col-12">
                    <a class="btn btn-primary" href="{{ route('course.create') }}"><i class="fa fa-calendar-plus-o"></i>新增學科</a>
                </div>
                @endcan
                <div class="col-12 pt-3">
                    <div id="accordion">
                        @foreach($data as $v)
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <a class="card-link" data-toggle="collapse" href="#collapse{{ $v->id }}">
                                            {{ $v->name }}
                                        </a>
                                    </div>
                                    <div class="col-6 text-right">
                                        @can('course.update')
                                            <a href="{{ route('course.edit',['course'=>$v]) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('course.delete')
                                            <a class="btn btn-danger text-right" data-toggle="modal" data-target="#myModal{{ $v->id }}"><i class="fas fa-trash-alt" style="color: white"></i></a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div id="collapse{{ $v->id }}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    {!! $v->intro !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @foreach($data as $v)
    <div class="modal" id="myModal{{ $v->id }}">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('course.destroy',['course',$v]) }}">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">刪除！</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="color: red;font-size: 1.5rem">
                    確定刪除"{{ $v->name }}"學科嗎？<br>這將會刪除所有相關的資料內容！
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">刪除</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>

            </form>
        </div>
    </div>
    @endforeach
@endsection
