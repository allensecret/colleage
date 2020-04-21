@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=email_config_li]').addClass('active');
            $('div[name=email_config]').addClass('show');

            $('#email_edit').summernote({
                tabsize: 3,
                height: 500
            });
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">信件管理</li>
        <li class="breadcrumb-item text_label"><b>新生入學信件</b></li>
    </ol>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <form class="row" action="{{ route('email_config_enrollment_save',['type'=>'enrollment_email_notice']) }}" method="post">
                @csrf
                <div class="col-8">
                    <h1>新生入學信件：</h1>
                </div>
                <div class="col-4" style="text-align: right">
                    @can('email_config_enrollment.update')
                    <button type="submit" class="btn btn-primary">保存</button>
                    @endcan
                </div>

                <div class="col-12" >
                    <textarea id="email_edit" name="content">{{ $data->content ?? "" }}</textarea>
                </div>
            </form>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
