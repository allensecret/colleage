@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=lift_li]').addClass('active');
            $('div[name=lift]').addClass('show');
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
            @include('MGplatform.layouts.alert')
            <div class="row">
                <div class="col-8">
                    <div class="form-inline" id="term">
                        <div class="input-group">
                            <label for="sel1">選擇年級：</label>
                            <select class="form-control" id="s_level" name="s_level" onchange="location = this.value;">
                                <option value="">請選擇年級</option>
                                @foreach($option_level as $l)
                                    <option value="{{ route('students_update.index',['level'=>$l->id]) }}" {{ $level == $l->id ? "selected":"" }}>{{ $l->level }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-4" >
                    @can('students_update.update')
                    <button class="btn btn-primary" style="float: right" data-toggle="modal" data-target="#exception_update">流程外升降級管理</button>
                    @endcan
                </div>
                <div class="col-12" style="padding-top: 1rem;text-align: center">
                    <form action="{{ route('students_update.show',['students_update'=>$level]) }}">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>通過</th>
                                    <th>課程編號</th>
                                    <th>標題</th>
                                    <th>種類</th>
                                    <th>授課老師</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($curricula as $c)
                                    <tr class="table-{{ $c->compulsory == 1 ? "success":"warning" }}">
                                        <td>
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="{{ $c->id }}" name="selected[]" {{ $c->compulsory == 1 ? "checked":"" }}>通過
                                            </label>
                                        </td>
                                        <td>{{ $c->coursedata->sn }}</td>
                                        <td>{{ $c->coursedata->title }}</td>
                                        <td>{{ $c->compulsory == 1 ?"必修":"選修" }}</td>
                                        <td>{{ $c->coursedata->teacher }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            @can('students_update.update')
                            <button type="submit" class="btn btn-success">篩選</button>
                            <button type="reset" class="btn btn-warning">重置</button>
                            @endcan
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
    @include('MGplatform.StudentUpdate.students_exception_update')
@endsection
