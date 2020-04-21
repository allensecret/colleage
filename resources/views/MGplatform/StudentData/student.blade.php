@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=student_li]').addClass('active');
            $('div[name=student]').addClass('show');

            $('#Number_pen').children().each(function () {
               if($(this).text() == "{{ old('Number_pen') }}"){
                   $(this).attr("selected","true");
               }
            });

            $("#Number_pen").change(function () {
                $("#page_form").submit();
            });
        });
    </script>
@endpush

@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            學生管理
        </li>
        <li class="breadcrumb-item text_label">學生資料</li>
    </ol>
@endsection
@section('content')
    <div class="row align-items-stretch">
        <div class="col-8">
            <form class="form-inline" action="{{ route('data.index') }}">
                <label for="search" class="mb-2 mr-sm-2 ">搜尋：</label>
                <div class="input-group">
                    <input type="text" class="form-control mb-2 mr-sm-0" id="search" name="search" placeholder="姓名\學號\電子郵件\電話" size="30" value="{{ old('search') }}">
                    <input type="hidden" value="{{ $level }}" name="level">
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
                    <option>30</option>
                    <option>50</option>
                    <option>70</option>
                    <option>100</option>
                </select>
            </form>
        </div>
        <div class="col-12">
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item">
                    <a class="nav-link {{ empty($level) ? 'active':"" }}" href="{{ route('data.index',['level'=>'']) }}">全部</a>
                </li>
                @foreach($course_level as $l)
                    <li class="nav-item">
                        <a class="nav-link {{ $level == $l->id ? 'active':"" }}" href="{{ route('data.index',['level'=>$l->id]) }}">{{ $l->level }}</a>
                    </li>
                @endforeach
            </ul>
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th>管理</th>
                    <th>學號</th>
                    <th>姓名</th>
                    <th>法號</th>
                    <th>性別</th>
                    <th>國籍</th>
                    <th>E-Mail</th>
                    <th>電話</th>
                    <th>地址</th>
                    <th>申請日期</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $v)
                    <tr>
                        <td>
                            @can('data.delete')
                                <a href="#student_data_delete{{ $v->id }}" data-toggle="modal"><i class="fa fa-trash" style="color: red;font-size: 1.2rem"></i></a>&nbsp;&nbsp;&nbsp;
                            @endcan
                            @can('data.update')
                                <a href="{{ route('data.edit',['data'=>$v,'page'=>1,'level'=>$level]) }}" style="color: blue;font-size: 1.2rem"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                            @endcan
                            <a href="{{ route('data.show',['data'=>$v]) }}" style="color: green;font-size: 1.2rem"><i class="fa fa-address-card"></i></a>
                        </td>
                        <td>{{ $v->account }}</td>
                        <td>{{ $v->name }}</td>
                        <td>{{ $v->dharma_name }}</td>
                        <td>{{ $v->gender }}</td>
                        <td>{{ $v->nationality }}</td>
                        <td>{{ $v->email }}</td>
                        <td>{{ $v->phone }}</td>
                        <td>{{ $v->address }}</td>
                        <td>{{ $v->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    {{ $data->links() }}
@endsection
@include('MGplatform.StudentData.modals.student_data_delete')
