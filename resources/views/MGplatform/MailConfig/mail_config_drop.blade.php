@extends('MGplatform.layouts.layout')
@push('script')
<script>
    $(document).ready(function() {
        $('li[name=email_config_li]').addClass('active');
        $('div[name=email_config]').addClass('show');

        $('textarea').summernote({
            tabsize: 3,
            height: 200
        });
    });
</script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">信件管理</li>
        <li class="breadcrumb-item text_label">休復學信件</li>
    </ol>
@endsection
@section('content')
    <div class="row align-items-stretch">
        <div class="col-12 pb-3">
            <form class="row" action="{{ route('email_config_dropout',['type'=>'dropout_email_notice']) }}" method="post">
                @csrf
                <div class="col-4">
                    <h3>休學信件</h3>
                </div>
                <div class="col-8" style="text-align: right">
                    @can('email_config_drop.update')
                    <button type="submit" class="btn btn-primary">保存</button>
                    @endcan
                </div>

                <div class="col-12" style="padding-top: 1%">
                    <textarea id="message_edit" name="content">{{ $dropout->content ?? "" }}</textarea>
                </div>
            </form>
        </div>

        <div class="col-12 pb-3">
            <form class="row" action="{{ route('email_config_dropin',['type'=>'dropin_email_notice']) }}" method="post">
                @csrf
                <div class="col-4">
                    <h3>復學信件</h3>
                </div>
                <div class="col-8" style="text-align: right">
                    @can('email_config_drop.update')
                    <button type="submit" class="btn btn-primary">保存</button>
                    @endcan
                </div>

                <div class="col-12" style="padding-top: 1%">
                    <textarea id="message_edit" name="content">{{ $dropin->content ?? "" }}</textarea>
                </div>
            </form>
        </div>
    </div>
@endsection
