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
        <li class="breadcrumb-item text_label"><b>升級紀錄名單</b></li>
    </ol>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="nput-group">
                        <input type="text" class="form-control" name="search" id="search" placeholder="查詢學號.....">
                    </div>
                </div>
                <div class="col-9">
                </div>
                <div class="col-12 pt-3 text-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>管理</th>
                                <th>學生</th>
                                <th>新年級</th>
                                <th>舊年級</th>
                                <th>新學號</th>
                                <th>舊學號</th>
                                <th>更新日期</th>
                            </tr>
                        </thead>
                        <tbody class="table-success" id="myTable">
                            @foreach($data as $v)
                            <tr>
                                <td>
                                    @can('recode_update.delete')
                                        <a href="#delete{{ $v->id }}" data-toggle="modal"><i class="fas fa-trash" style="color: red;font-size: 1.3rem"></i></a>
                                    @endcan
                                </td>
                                <td>{{ $v->get_student->name }}</td>
                                <td>{{ \App\CourseLevel::where('id',$v->new_level)->first()->level }}</td>
                                <td>{{ \App\CourseLevel::where('id',$v->old_level)->first()->level }}</td>
                                <td>{{ $v->new_student_id }}</td>
                                <td>{{ $v->old_student_id }}</td>
                                <td>{{ $v->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
{{--@include('MGplatform.UpdateRecode.modals.delete')--}}
