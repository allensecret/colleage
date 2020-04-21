@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=management_li]').addClass('active');
            $('div[name=management]').addClass('show');
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">網路系統管理</li>
        <li class="breadcrumb-item text_label"><b>登入歷史</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h3>登入歷史</h3>
                </div>
                <div class="col-12 pt-3">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>名稱</th>
                            <th>帳號</th>
                            <th>ＩＰ</th>
                            <th>時間</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->account }}</td>
                                    <td>{{ $d->ip }}
                                    <td>{{ $d->visitor_time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
        {{ $data->links() }}
    </div>
@endsection

