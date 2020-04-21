@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=student_li]').addClass('active');
            $('div[name=student]').addClass('show');

        });
    </script>
@endpush

@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            學生管理
        </li>
        <li class="breadcrumb-item text_label">休學/復學</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="form-inline">
                <label for="search" class="mb-2 mr-sm-2 ">搜尋：</label>
                <div class="input-group">
                    <input type="text" class="form-control mb-2 mr-sm-0" id="search" name="search" placeholder="姓名\學號\電子郵件\電話" size="30" value="{{ old('search') }}">
                </div>
            </div>
        </div>
        <div class="col-12">
            <ul class="nav nav-pills nav-justified">
                @can('drop.view')
                <li class="nav-item">
                    <a class="nav-link {{ $type == 1 ? "active":"" }}" href="{{ route('drop.index',['type'=>1]) }}">休學</a>
                </li>
                @endcan
                @can('drop_in.view')
                <li class="nav-item">
                    <a class="nav-link {{ $type == 2 ? "active":"" }}" href="{{ route('drop.index',['type'=>2]) }}">復學</a>
                </li>
                    @endcan
            </ul>

            <!-- Tab panes -->
            <div class="tab-content mt-3">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>管理</th>
                            <th>狀態</th>
                            <th>學號</th>
                            <th>姓名</th>
                            <th>E-Mail</th>
                            <th>類別</th>
                            <th>原因</th>
                            <th>申請日期</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>
                                    @if($d->term == 0)
                                        <a href="#pass{{ $d->id }}" data-toggle="modal" class="btn btn-info" style="font-size: 0.5rem">通過</a>
                                        <a href="#unpass{{ $d->id }}" data-toggle="modal" class="btn btn-danger" style="font-size: 0.5rem">不通過</a>
                                    @endif
                                </td>
                                <td>
                                    @switch($d->term)
                                        @case(0)
                                            未審核
                                            @break
                                        @case(1)
                                            通過
                                            @break
                                        @case(2)
                                            不通過
                                            @break
                                    @endswitch
                                </td>
                                <td>{{ $d->student_data->account }}</td>
                                <td>{{ $d->student_data->data->name }}</td>
                                <td>{{ $d->student_data->data->email }}</td>
                                <td>
                                    @switch($d->item)
                                        @case(1)
                                            休學
                                            @break
                                        @case(2)
                                            復學
                                            @break
                                    @endswitch
                                </td>
                                <td><a href="#reason{{ $d->id }}" style="font-size: 1.3rem" data-toggle="modal"><i class="fas fa-receipt"></i></a> </td>
                                <td>{{ date("Y-m-d",strtotime($d->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@include('MGplatform.Drop.modals.reason')
@include('MGplatform.Drop.modals.pass')
@include('MGplatform.Drop.modals.unpass')
