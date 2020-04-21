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
        <li class="breadcrumb-item text_label"><b>認識學院</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="content-wrapper">
        <form class="container-fluid" action="{{ route('edit_understanding_save',['type'=>$type]) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-8">
                    <h2>認識學院</h2>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary" style="float: right"><i class="fas fa-save"></i> 保存</button>
                </div>
                <div class="col-12 pt-3">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 'understanding_intro'?"active":"" }}" href="{{ route('edit_understanding',['type'=>'understanding_intro']) }}">簡介</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 'understanding_origin'?"active":"" }}" href="{{ route('edit_understanding',['type'=>'understanding_origin']) }}">成立緣起</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 'understanding_purpose'?"active":"" }}" href="{{ route('edit_understanding',['type'=>'understanding_purpose']) }}">教學宗旨</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 'understanding_teach'?"active":"" }}" href="{{ route('edit_understanding',['type'=>'understanding_teach']) }}">學院院訓</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 'understanding_way'?"active":"" }}" href="{{ route('edit_understanding',['type'=>'understanding_way']) }}">教學方式</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 'understanding_introduction'?"active":"" }}" href="{{ route('edit_understanding',['type'=>'understanding_introduction']) }}">修學介紹</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $type == 'understanding_future'?"active":"" }}" href="{{ route('edit_understanding',['type'=>'understanding_future']) }}">未來展望</a>
                        </li>
                    </ul>

                    <div class="col-12 pt-3">
                        <textarea id="message_edit" name="content">{{ $data->content ?? "" }}</textarea>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
