@extends('Frontplatform.layouts.layout')
@push('style')

    <style>
        .submit_btn{
            font-family: 'DFXingShuStd-W5';
            font-size: 1.2rem;
            margin-right: 1.2rem;
            padding: 5px 15px 5px 15px;
            border-radius: 20px;
            border: none;
            background-color: rgb(154, 164, 170);
            color: #ffffff;
        }


        .card-header.note-toolbar{
            padding-left: 20px;
            background-color: rgb(213,209,205);
            border-radius: 15px 15px 0px 0px;
        }

        .note-editor.note-frame{
            box-shadow: 4px 4px 12px -5px rgba(20%, 20%, 40%, 0.7);
            border:0px;
            border-radius: 15px;
        }

        .note-btn-group .note-btn{
            border: 0.5px solid #000000;
            background-color: #ffffff;
        }

        #item{
            font-size: 1.3rem;
            border: 0;
            background-color: rgb(247,245,241);
            width: 130px;
            height: 36px;

        }

        .note-editable{
            height: 700px !important;
        }

    </style>
@endpush
@section('content')
    <div class="row div-content">
        <form class="col-12" action="{{ route('report.store',['curricula'=>$report]) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                    <h1><a href="{{ url()->previous() }}" style="color: rgb(154, 164, 170);"><i class="fas fa-angle-left"></i></a>  課程：{{ $report->course->coursedata->title }}</h1>
                </div>
                <div class="col-6 text-right">
                    <button class="btn submit_btn" type="submit">送出文章</button>
                </div>
                <div style="color: #ef0d0c">{{ $errors->first('content') }}</div>
                <div class="col-12 pt-3">
                    <textarea name="content" id="content">{{ old('content') }}</textarea>
                </div>
            </div>
        </form>
    </div>
@endsection
