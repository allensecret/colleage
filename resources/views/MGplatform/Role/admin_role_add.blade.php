@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=management_li]').addClass('active');
            $('div[name=management]').addClass('show');

            $('.selectAll_button button').each(function () {
                $(this).click(function () {
                    if ($("input[name='functions["+$(this).attr('id').replace('_selectAll','')+"][]']").is(':checked')) {
                        $("input[name='functions["+$(this).attr('id').replace('_selectAll','')+"][]']").prop('checked', false);
                    } else {
                        $("input[name='functions["+$(this).attr('id').replace('_selectAll','')+"][]']").prop('checked', true);
                    }
                });
            });

            $('.class_selectAll_button button').each(function () {
               $(this).click(function () {
                   if ($("input[name='courses["+$(this).attr('id').replace('_selectAll','')+"][]']").is(':checked')) {
                       $("input[name='courses["+$(this).attr('id').replace('_selectAll','')+"][]']").prop('checked', false);
                   } else {
                       $("input[name='courses["+$(this).attr('id').replace('_selectAll','')+"][]']").prop('checked', true);
                   }
               });
            });
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">網路系統管理</li>
        <li class="breadcrumb-item">角色權限</li>
        <li class="breadcrumb-item text_label"><b>新增角色與權限</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <form class="row" action="{{ route('role.store') }}" method="post">
                @csrf
                <div class="col-8">
                    <a href="{{ route('role.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>返回</a>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary" style="float: right"><i class="fas fa-plus"></i>新增</button>
                </div>
                <div class="col-12 pt-3">
                    <div class="form-group">
                        <label for="Character" style="font-size: 1.3rem">角色名稱：</label>
                        <input type="text" class="form-control" id="Character" name="Character">
                        <div style="color: red">{{ $errors->first('Character') }}</div>
                    </div>
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">功能</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">課程</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active"><br>
                            <div class="d-flex flex-column">
                                @foreach($features as $f)
                                    <div class="p-3">
                                        <h3>{{ $f->name }}</h3>
                                        <div class="d-flex justify-content-start flex-wrap">
                                            @foreach($f->item as $i)
                                                <div class="p-2">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="p-2"><h4 class="card-title">{{ $i->item }}</h4></div>
                                                                <div class="p-2 selectAll_button"><button type="button" class="btn btn-primary btn-sm" id="{{ $i->name }}_selectAll">全選</button></div>
                                                            </div>

                                                            <p class="card-text">
                                                            @foreach(array_filter(mb_split(";",$i->option)) as $s)
                                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                                    <input type="checkbox" class="custom-control-input" id="{{ $i->name.$loop->iteration }}" name="functions[{{ $i->name }}][]" value="{{ $s }}">
                                                                    <label class="custom-control-label" for="{{ $i->name.$loop->iteration }}">
                                                                        @switch($s)
                                                                            @case('review')
                                                                                預覽
                                                                                @break
                                                                            @case('edit')
                                                                                編輯
                                                                                @break
                                                                            @case('delete')
                                                                                刪除
                                                                                @break
                                                                        @endswitch
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="menu1" class="container tab-pane fade"><br>
                            <div class="row">
                                @foreach($class as $c)
                                    <div class="col-12 col-sm-12 col-md-4 pl-5 pb-3">
                                        <div class="row">
                                            <div class="col-6"><h4>{{ $c->level }}</h4></div>
                                            <div class="col-6 text-right class_selectAll_button"><button type="button" class="btn btn-primary btn-sm" id="class_level_{{ $c->id }}_selectAll">全選</button></div>
                                        </div>
                                        <hr>
                                        @foreach($c->curricula as $curricula)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="class_course{{ $curricula->id }}" name="courses[class_level_{{ $c->id }}][]" value="{{ $curricula->id }}">
                                                <label class="custom-control-label" for="class_course{{ $curricula->id }}">{{ $curricula->coursedata->title }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
