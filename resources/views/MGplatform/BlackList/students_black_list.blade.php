@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=student_li]').addClass('active');
            $('div[name=student]').addClass('show');

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
        <li class="breadcrumb-item">學生管理</li>
        <li class="breadcrumb-item text_label"><b>黑名單</b></li>
    </ol>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('MGplatform.layouts.alert')
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 form-inline">
                    <label for="search" class="mr-sm-2" style="font-size: 1.2rem">搜尋：</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="search" placeholder="姓名\學號\電子郵件\電話" size="30">
                </div>
                <div class="col-4">
                    @can('blacklist.create')
                    <button class="btn btn-danger" style="float: right" data-toggle="modal" data-target="#black_list_add">添加黑名單學員</button>
                    @endcan
                </div>
                <div class="col-12" style="padding-top: 1rem">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>管理</th>
                                <th>班級</th>
                                <th>學號</th>
                                <th>姓名</th>
                                <th>電子郵件</th>
                                <th>電話</th>
                                <th>黑名單時間</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                        @foreach($data as $v)
                            <tr>
                                <td>
                                    @can('blacklist.delete')
                                    <button class="btn" style="color: red" data-toggle="modal" data-target="#black_list_delete{{ $v->id }}" ><i class="fas fa-times"></i></button>
                                    @endcan
                                </td>
                                <td>{{ $v->get_student->data->level->level }}</td>
                                <td>{{ $v->get_student->account }}</td>
                                <td>{{ $v->get_student->name }}</td>
                                <td>{{ $v->get_student->data->email }}</td>
                                <td>{{ $v->get_student->data->cellphone }}</td>
                                <td>{{ $v->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
@include('MGplatform.BlackList.modals.students_black_add')
@include('MGplatform.BlackList.modals.students_black_delete')
