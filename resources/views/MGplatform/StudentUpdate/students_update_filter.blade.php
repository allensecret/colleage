@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=lift_li]').addClass('active');
            $('div[name=lift]').addClass('show');

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
        <li class="breadcrumb-item">升降級管理</li>
        <li class="breadcrumb-item text_label"><b>學生升級管理</b></li>
    </ol>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <a href="{{ route('students_update.index',['level'=>$students_update]) }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>返回</a>
                </div>
                <div class="col-4" >
                    <form class="form-inline" action="" id="term" style="float: right;">
                        <div class="input-group">
                            <input type="text" class="form-control" id="search" name="search" placeholder="查詢學號.....">
                        </div>
                    </form>
                </div>
                <div class="col-12" style="padding-top: 1rem;text-align: center">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 1?"active":"" }}" href="{{ route('students_update.show',['students_update'=>$students_update,'status'=>1,'selected'=>$selected]) }}">可升級學員</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 0?"active":"" }}" href="{{ route('students_update.show',['students_update'=>$students_update,'status'=>0,'selected'=>$selected]) }}">留原級</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="update" class="container tab-pane active"><br>
                            @switch($status)
                                @case(1)
                                    <form action="{{ route('update') }}" method="POST">
                                        @csrf
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>管理  <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-arrow-up"></i>升級</button></th>
                                                <th>年級</th>
                                                <th>學號</th>
                                                <th>學生</th>
                                                <th>德性成績</th>
                                                <th>已提交報告</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-success" id="myTable">
                                            @foreach($list as $l)
                                                @php
                                                    $i = 0;
                                                    foreach($l->curriculas as $c){
                                                        if(in_array($c->curricula,$selected) && $c->grade != null){
                                                            $i++;
                                                        }
                                                    }
                                                @endphp
                                                @if($i >= count($selected))
                                                    <tr>
                                                        <td>
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input" name="update_list[]" value="{{ $l->id }}" checked>升級
                                                            </label>
                                                        </td>
                                                        <td>{{ $l->data->level->level }}</td>
                                                        <td>{{ $l->account }}</td>
                                                        <td>{{ $l->name }}</td>
                                                        <td>100</td>
                                                        <td>
                                                            <a href="#" data-toggle="modal" data-target="#sumbit_report{{ $l->id }}"><i class="fas fa-clipboard-list"></i></a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                    @break
                                @case(0)
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>管理</th>
                                            <th>年級</th>
                                            <th>學號</th>
                                            <th>學生</th>
                                            <th>德性成績</th>
                                            <th>已提交報告</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-danger" id="myTable">
                                        @foreach($list as $l)
                                            @php
                                                $i = 0;
                                                foreach($l->curriculas as $c){
                                                    if(in_array($c->curricula,$selected) && $c->grade == null){
                                                        $i++;
                                                    }
                                                }
                                            @endphp
                                            @if($i > 0)
                                                <tr>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#update_exception{{ $l->id }}"><i class="fas fa-user-edit"></i></a>
                                                    </td>
                                                    <td>{{ $l->data->level->level }}</td>
                                                    <td>{{ $l->account }}</td>
                                                    <td>{{ $l->name }}</td>
                                                    <td>0</td>
                                                    <td>
                                                        <a href="#" data-toggle="modal" data-target="#sumbit_report{{ $l->id }}"><i class="fas fa-clipboard-list"></i></a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @break
                            @endswitch
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
    @include('MGplatform.StudentUpdate.modals.student_submit_report')
    @include('MGplatform.StudentUpdate.modals.update_exception')
@endsection
