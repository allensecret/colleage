@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=grade_li]').addClass('active');
            $('div[name=grade]').addClass('show');

            $("#level").change(function () {
                $('#curriculum').val("");
                $("#term_form").submit();
            });
            $("#curriculum").change(function () {
                $("#term_form").submit();
            });

            $("#level").children().each(function(){
                if ($(this).val() == "{{ $s_level }}"){
                    $(this).attr("selected", true);
                }
            });

            $('#curriculum').children().each(function () {
                if($(this).val() == "{{ $s_curricula }}"){
                    $(this).attr("selected", true);
                }
            });
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">成績管理</li>
        <li class="breadcrumb-item text_label"><b>課程作業評分</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <form class="form-inline" action="{{ route('work_grade.index',['status'=>$status]) }}" id="term_form" name="term_form">
                        <label for="level">年級：</label>
                        <select class="form-control" id="level" name="level">
                            <option value="">請選擇年級</option>
                            @foreach($level as $l)
                                <option value="{{ $l->id }}" >{{ $l->level }}</option>
                            @endforeach
                        </select>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="course">課程：</label>
                        <select class="form-control" id="curriculum" name="curriculum">
                            <option value="">請選擇課程</option>
                            @foreach($curricula as $c)
                                @if(strpos(Auth::user()->role_name->course,'class_level_'.$s_level.'.'.$c->id) !== false || Auth::user()->role_name->course == '777')
                                    <option value="{{ $c->id }}">{{ $c->coursedata->sn." ".$c->coursedata->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="col-4">
                    @can('work_grade.view')
                    <a href="{{ route('UnReport.index',['level'=>$s_level,'curricula'=>$s_curricula]) }}" class="btn btn-info float-right">未遞交作業</a>
                    @endcan
                </div>
                <div class="col-12" style="padding-top: 1rem">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ $status == '' ? "active":"" }}" href="{{ route('work_grade.index',['level'=>$s_level,'curriculum'=>$s_curricula]) }}" id="all">全部</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == '1' ? "active":"" }}" href="{{ route('work_grade.index',['status'=>1,'level'=>$s_level,'curriculum'=>$s_curricula]) }}" id="unreviewed">未審核</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == '2' ? "active":"" }}" href="{{ route('work_grade.index',['status'=>2,'level'=>$s_level,'curriculum'=>$s_curricula]) }}" id="reviewed">已審核</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == '3' ? "active":"" }}" href="{{ route('work_grade.index',['status'=>3,'level'=>$s_level,'curriculum'=>$s_curricula]) }}" id="reviewed">審核未過</a>
                        </li>
                    </ul>
                    <div class="tab-content" style="padding-top: 1rem">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>狀態</th>
                                {{--<th>作業</th>--}}
                                <th>成績</th>
                                <th>學號</th>
                                <th>遞交時間</th>
                                <th>批改時間</th>
                                <th>評語/評分</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($report as $r)
                                @if($r->get_student->data->course_level == $s_level)
                                    <tr>
                                        <td>
                                            @switch($r->done)
                                                @case(1)
                                                    未審核
                                                    @break
                                                @case(2)
                                                    已審核
                                                    @break
                                                @case(3)
                                                    不通過
                                                    @break
                                            @endswitch
                                        </td>
                                        {{--<td>--}}
                                            {{--@can('work_grade.view')--}}
                                            {{--<button class="btn" data-toggle="modal" data-target="#report{{ $r->id }}"><i class="fas fa-file-alt" style="color: green"></i></button>--}}
                                            {{--@endcan--}}
                                        {{--</td>--}}
                                        <td>{{ $r->grade }}</td>
                                        <td>{{ $r->get_student->account }}</td>
                                        <td>{{ date("Y年m月d日",strtotime($r->report_date)) }}</td>
                                        <td>{{ $r->respond_date != null ? date("Y年m月d日",strtotime($r->respond_date)) :'' }}</td>
                                        <td>
                                            @can('work_grade.update')
                                                <a href="{{ route('work_grade.edit',['work_grade'=>$r]) }}"><i class="fas fa-pencil-alt" style="color: darkolivegreen"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        {{ $report->links() }}
                    </div>

                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
{{--@include('MGplatform.WorkGrade.modals.work_grade_report')--}}
