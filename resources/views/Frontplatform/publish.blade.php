@extends('Frontplatform.layouts.layout')
@push('style')

    <style>
        .item_btn{
            font-size: 1.3rem;
            padding: 0px 0px 0px 0px;
        }

        .item{
            font-family: 'DFXingShuStd-W5';
            color: white;
            font-size: 1.3rem;
            width: 230px;
            padding: 3px 0px 3px 15px;
            background-color: rgb(213,209,205);
            border-radius: 15px;
            position: relative;
        }

        .item_text{
            position: absolute;
            top: 0;
            right: 0;
            font-family: 'DFXingShuStd-W5';
            color: black;
            width: 160px;
            padding: 0px 0px 3px 15px;
            background-color: rgb(247,245,241);
            border-radius: 15px;
            text-align: center;
        }

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

        select#item.custom-select{
            padding: 0px;
        }

        @media only screen and (max-width: 425px) {
            .item_text{
                position: absolute;
                top: 0;
                right: 0;
                font-family: 'DFXingShuStd-W5';
                color: black;
                width: 160px;
                padding: 0px 0px 3px 15px;
                background-color: rgb(247,245,241);
                border-radius: 15px;
                text-align: center;
            }


        }

    </style>
@endpush
@section('content')
    @include('Frontplatform.layouts.alert')
<div class="row div-content">
    <div class="col-12 pt-4 pb-3">
        <h1><a href="{{ route('discussion.index') }}" style="color: rgb(154, 164, 170);"><i class="fas fa-angle-left"></i></a>  發新帖子</h1>
    </div>
    <form class="col-12" action="{{ route('discussion.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-6 pb-3">
                <div class="item">
                    <span class="text-left">看板</span>
                    <div class="item_text">
                        <select class="custom-select" id="item" name="type">
                            @foreach($type as $t)
                                @if($t->type != '欣賞修學報告')
                                    <option value="{{ $t->id }}">{{ $t->type }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 text-right ">
                <button class="btn submit_btn" type="submit">送出文章</button>
            </div>
            <div style="color: red">{{ $errors->first('title') }}</div>
            <div class="col-12 mt-3 title-div" style="display: inline-flex;flex-direction: row;">
                <label for="title" style="white-space:nowrap;line-height: 40px;font-size: 1.3rem">標題：</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div style="color: red">{{ $errors->first('content') }}</div>
            <div class="col-12 pt-3">
                <textarea name="content"></textarea>
            </div>
        </div>
    </form>
</div>
@endsection
