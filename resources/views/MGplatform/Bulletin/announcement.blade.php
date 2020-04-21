@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=announcement_li]').addClass('active');

            $('.announcement_content').summernote({
                tabsize: 3,
                height: 300
            });

            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">討論版管理</li>
        <li class="breadcrumb-item text_label"><b>公告管理</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 form-inline">
                    <label for="search" class="mr-sm-2">搜尋：</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="search" size="30">
                </div>
                <div class="col-4 text-right">
                    @can('bulletin.create')
                    <button class="btn btn-primary" data-toggle="modal" data-target="#type_add">新增公告類型</button>
                    <button class="btn btn-info" data-toggle="modal" data-target="#add"><i class="fas fa-sticky-note"></i> 新增消息</button>
                    @endcan
                </div>
                <div class="col-12">
                    <ul class="nav nav-tabs nav-justified" style="padding-bottom: 1rem">
                        @if(!empty($type))
                            @foreach($type as $t)
                                <li class="nav-item">
                                    <a class="nav-link {{ $t->id == $select ? "active":"" }}" href="{{ route('bulletin.index',['id'=>$t->id]) }}">{{ $t->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                {{--<th>管理</th>--}}
                                <th>主題</th>
                                <th>回覆</th>
                                <th>建立時間</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                        @if(!empty($type))
                            @foreach($news as $v)
                                <tr>
                                    <td>
                                        @can('bulletin.view')
                                            <a href="{{ route('bulletin.show',['bulletin'=>$v]) }}">
                                                {{ $v->title }}
                                            </a>
                                        @endcan
                                    </td>
                                    <td>
                                        {{ count($v->get_replies) }}
                                    </td>
                                    <td>{{ $v->created_at }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
@include('MGplatform.Bulletin.modals.type_add')
@include('MGplatform.Bulletin.modals.add')

