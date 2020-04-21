@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .message_btn{
            font-family: 'DFXingShuStd-W5';
            font-size: 2rem;
            margin-right: 1.2rem;
            padding: 0px 30px 0px 30px;
            border-radius: 10px;
            border: none;
            background-color: rgb(154, 164, 170);
            color: #ffffff;
        }

        .msg_div {
            padding: 30px 50px 50px 50px;
            background-color: rgb(247, 245, 241);
            border-radius: 10px;
            box-shadow: 4px 4px 12px -5px rgba(20%, 20%, 40%, 0.7);
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

        .msg_btn{
            font-family: 'DFXingShuStd-W5';
            font-size: 1.6rem;
            margin-right: 1.2rem;
            padding: 0px 15px 0px 15px;
            border-radius: 15px;
            border: none;
            background-color: rgb(247,245,241);
            color: black;
        }
        .msg_btn:hover{
            background-color: rgb(154, 164, 170);
        }

        .fixed {
            position: fixed;
            bottom: 100px;
            right: 0;
            border-radius: 50px;
            background: rgba(228, 211, 211, 0.36);
            cursor: pointer;
            z-index: 1000;
            padding: 10px 16px;
        }

        .fa-caret-up{
            color: black;
            font-size: 1.3rem;
        }

        .fa-edit{
            color: #e9aa0b;
            font-size: 1.3rem;
        }

        .fa-trash{
            color: #ef0d0c;
            font-size: 1.3rem;
        }

        @media only screen and (min-width: 425px) and (max-width: 768px) {
            .msg_div {
                padding: 30px 20px 50px 20px;
                background-color: rgb(247, 245, 241);
                border-radius: 10px;
                box-shadow: 4px 4px 12px -5px rgba(20%, 20%, 40%, 0.7);
            }
        }

        @media only screen and (max-width: 425px) {
            .msg_div {
                padding: 30px 10px 50px 10px;
                background-color: rgb(247, 245, 241);
                border-radius: 10px;
                box-shadow: 4px 4px 12px -5px rgba(20%, 20%, 40%, 0.7);
            }
        }

        @media only screen and (max-width: 320px) {
            .msg_div {
                padding: 30px 10px 50px 10px;
                background-color: rgb(247, 245, 241);
                border-radius: 10px;
                box-shadow: 4px 4px 12px -5px rgba(20%, 20%, 40%, 0.7);
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#message').click(function(){
                $('html, body').animate({scrollTop: $('#message_form').offset().top}, 1000);
            });

            var size = $("p").css('font-size');
            if(parseInt(size)<18){
                $("p").css('font-size','18px');
            }
        });
    </script>
@endpush
@section('content')
    @include('Frontplatform.layouts.alert')
    <div class="row div-content">
        <div class="col-12 pb-4 pt-4">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <h1><a href="{{ route('discussion.index',['type'=>$type]) }}" style="color: rgb(154, 164, 170);"><i class="fas fa-angle-left"></i></a>   標題:{{ $discussion->title }}</h1>
                </div>
                <div class="col-12 col-lg-4 text-right">
                    @if(empty(\Illuminate\Support\Facades\Auth::user()->black))
                        @if($type != 5)
                            <a href="#" class="btn message_btn" id="message">留言</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row pb-4">
                <div class="col-12 col-lg-9 msg_div">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4" style="font-size: 1.2rem">
                            發表人：{{ $discussion->student_name->account }}
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-8" style="font-size: 1.2rem">
                            {{ $discussion->created_at }}
                        </div>
                        @if($discussion->student == \Illuminate\Support\Facades\Auth::user()->id)
                            <div class="col-12 col-lg-2 text-right">
                                <div class="d-flex justify-content-between">
                                    <div class="p-2"><a href="{{ route('discussion.edit',['discussion'=>$discussion]) }}" ><i class="fas fa-edit"></i></a></div>
                                    <div class="p-2"><a href="#delete" data-toggle="modal"><i class="fas fa-trash"></i></a></div>
                                </div>
                            </div>
                        @endif
                        <div class="col-12 pt-5" id="content_div">
                            {!! $discussion->content !!}
                        </div>
                    </div>
                </div>
                <div class="col-3 col-lg-3"></div>
            </div>
            @foreach($discussion->replies as $r)
            <div class="row pb-4">
                <div class="col-3 col-lg-3"></div>
                <div class="col-12 col-lg-9 msg_div">
                    <div class="row">
                        <div class="col-12 col-lg-4" style="font-size: 1.2rem">
                            留言：{{ $r->get_student_name->account }}
                        </div>
                        <div class="col-12 col-lg-8" style="font-size: 1.2rem">
                            時間：{{ $r->created_at }}
                        </div>
                        @if($r->student == \Illuminate\Support\Facades\Auth::user()->id)
                            <div class="col-12 col-lg-2 text-right">
                                <div class="d-flex justify-content-between">
                                    <div class="p-2"><a href="#edit{{ $r->id }}" data-toggle="modal"><i class="fas fa-edit"></i></a></div>
                                    <div class="p-2"><a href="#delete{{ $r->id }}" data-toggle="modal"><i class="fas fa-trash"></i></a></div>
                                </div>
                            </div>
                        @endif
                        <div class="col-12 pt-5">
                            {!! $r->content !!}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if(empty(\Illuminate\Support\Facades\Auth::user()->black))
                @if($type != 5)
                <form class="col-12 pt-5" id="message_form" action="{{ route('replies.store',['post'=>$discussion->id]) }}" method="post">
                    @csrf
                    <textarea name="content" id="summernote"></textarea>
                    <div class="pt-3 text-center">
                        <button class="btn msg_btn" type="submit">送出</button>
                    </div>
                </form>
                @endif
            @endif
            <div class="fixed text-center" id="gotop" style="display:none">
                <i class="fas fa-caret-up"></i>
            </div>
        </div>
    </div>

    @include('Frontplatform.modals.discussion_post_delete')
    @include('Frontplatform.modals.discussion_content_edit')
    @include('Frontplatform.modals.discussion_content_delete')
@endsection
