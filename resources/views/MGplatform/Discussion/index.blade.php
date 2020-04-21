@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=discussion_li]').addClass('active');


            $('#Number_pen').children().each(function () {
                if($(this).text() == "{{ $_GET['Number_pen'] ?? "15" }}"){
                    $(this).attr("selected","true");
                }
            });

            $("#Number_pen").change(function () {
                $("#page_form").submit();
            });

            //todo:刪除功能
            // $('table tr').click(function(){
            //     window.location = $(this).attr('href');
            //     return false;
            // });
        });
    </script>
@endpush

@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item text_label">
            留言板管理
        </li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="row align-items-stretch">
        <div class="col-8">
            <form class="form-inline" action="{{ route('discussionMG.index') }}">
                <label for="search" class="mb-2 mr-sm-2 ">搜尋：</label>
                <div class="input-group">
                    <input type="text" class="form-control mb-2 mr-sm-0" id="search" name="search" placeholder="學號/主題" size="30" value="{{ old('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-4">
            <form class="form-inline" style="float: right" action="{{ route('data.index') }}" id="page_form">
                <label for="Number_pen">筆數：</label>
                <select class="form-control" id="Number_pen" name="Number_pen">
                    <option>15</option>
                    <option>30</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </form>
        </div>
        <div class="col-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><a href="#delete_select" style="color:red;" data-toggle="modal"><i class="fas fa-trash-alt"></i></a></th>
                        <th>主題</th>
                        <th>發表者</th>
                        <th>回復</th>
                        <th>發表時間</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck{{ $d->id }}" name="delete[]">
                                <label class="custom-control-label" for="customCheck{{ $d->id }}"></label>
                            </div>
                        </td>
                        <td><a href="{{ route('discussionMG.show',['discussionMG'=>$d]) }}"> 【{{ $d->type_name->type }}】{{ $d->title }}</a></td>
                        <td>{{ $d->student_name->account }}</td>
                        <td>{{ $d->replies->count() }}</td>
                        <td>{{ date('Y-m-d',strtotime($d->created_at)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
    @include('MGplatform.Discussion.modals.delete_select')
@endsection
