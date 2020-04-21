@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=edit_li]').addClass('active');
            $('div[name=edit]').addClass('show');

            $('select[name=year]').change(function () {
                $('#term').submit();
            });

            $('textarea').summernote({
                tabsize: 3,
                height: 300
            });

        });
    </script>

@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">頁面編輯</li>
        <li class="breadcrumb-item text_label"><b>年度行事曆</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <h2>年度行事曆</h2>
                </div>
                <div class="col-4">
                    <form class="form-inline" action="{{ route('edit_calendar') }}" method="get" id="term" style="float: right">
                        <label for="calendar">學年度：</label>
                        <select class="form-control" id="year" name="year">
                            @for($i = 0;$i<=3;$i++)
                                <option value="{{ date('Y',strtotime("-".$i." year")) }}" {{ $year == date('Y',strtotime("-".$i." year")) ?"selected":""  }}>{{ date('Y',strtotime("-".$i." year")) }}</option>
                            @endfor
                        </select>
                    </form>
                </div>
                <div class="col-12" style="padding-top: 1rem">
                    @for($i=0;$i<12;$i++)
                    <div class="card" style="margin-bottom: 1%">
                        <div class="card-header">
                            <font style="font-size: 1.5rem">{{ date("Y-m",strtotime("+".$i." month",strtotime($year."-04"))) }}</font>
                            @can('edit_calendar.update')
                                <button class="btn btn-primary" style="float: right" data-target="#add_list{{ $i }}" data-toggle="modal"><i class="fas fa-plus"></i>新增辦理事項</button>
                            @endcan
                        </div>
                        <div class="card-body" style="font-size: 1.2rem">
                            @foreach($data as $v)
                                @if($v->date == date("Y-m",strtotime("+".$i." month",strtotime($year."-04"))))
                                    {!! $v->list !!}
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
@include('MGplatform.EditPage.modals.edit_calendar_add_list')
