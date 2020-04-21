@extends('MGplatform.layouts.layout')

@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=edit_li]').addClass('active');
            $('div[name=edit]').addClass('show');

            $('#message_edit').summernote({
                tabsize: 3,
                height: 600
            });
        });
    </script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">頁面編輯</li>
        <li class="breadcrumb-item text_label"><b>入學指導</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <form class="container-fluid" action="{{ route('edit_admission_guidance_save',['type'=>'guidance']) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-8">
                    <h2>入學指導</h2>
                </div>
                <div class="col-4">
                    @can('edit_admission_guidance.update')
                    <button type="submit" class="btn btn-primary" style="float: right"><i class="fas fa-save"></i> 保存</button>
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
