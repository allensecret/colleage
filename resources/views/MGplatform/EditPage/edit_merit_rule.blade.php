@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=edit_li]').addClass('active');
            $('div[name=edit]').addClass('show');

            $('textarea').summernote({
                tabsize: 3,
                height: 600
            });
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">頁面編輯</li>
        <li class="breadcrumb-item text_label"><b>修行守則</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <form class="container-fluid" action="{{ route('edit_merit_rule_save',['type'=>'merit_rule']) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-8">
                    <h2>修行守則</h2>
                </div>
                <div class="col-4">
                    @can('edit_merit_rule.update')
                        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> 保存</button>
                    @endcan
                </div>
                <div class="col-12 pt-3">
                    <textarea id="message_edit" name="content">{{ $data->content ?? "" }}</textarea>
                </div>
            </div>
        </form>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
