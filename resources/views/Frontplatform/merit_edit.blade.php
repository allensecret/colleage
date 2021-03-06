@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .back_btn{
            font-size: 1.3rem;
            padding: 0px 50px 0px 50px;
            border-radius: 10px;
            border: none;
            background-color: rgb(207,203,197);
            color: white;
        }

        .back_btn:hover{
            background-color: rgb(143,154,160);
            color: white;
        }

        .done_btn{
            font-family: 'DFXingShuStd-W5';
            font-size: 1.4rem;
            padding: 0px 100px 0px 100px;
            border-radius: 10px;
            border: none;
            background-color: rgb(207,203,197);
            color: white;
        }

        .done_btn:hover{
            background-color: rgb(143,154,160);
            color: white;
        }

        .select-div{
            font-size: 1.1rem;
        }

        h4{
            border-bottom: black solid 2px;
        }

        input[type="checkbox"]{
            top:10px;
        }


        @media only screen and (min-width: 768px) and (max-width: 1280px) {
            h1{
                font-size: 2.1rem;
            }

            .back_btn{
                font-size: 1.3rem;
                padding: 0px 20px 0px 20px;
                border-radius: 10px;
                border: none;
                background-color: rgb(207,203,197);
                color: white;
            }
        }
        @media only screen and (min-width: 425px) and (max-width: 768px) {
            .back_btn{
                font-size: 1.2rem;
                padding: 0px 20px 0px 20px;
                border-radius: 10px;
                border: none;
                background-color: rgb(207,203,197);
                color: white;
            }

            .form-check-label{
                font-size:1rem;
            }
        }


        @media only screen and (max-width: 425px) {
            h1{
                font-size: 1.8rem;
            }

            .back_btn{
                font-size: 1.08rem;
                padding: 0px 10px 0px 10px;
                border-radius: 10px;
                border: none;
                background-color: rgb(207,203,197);
                color: white;
            }

            .form-check-label{
                font-size:0.8rem;
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            @if($data->item_group->count() > 0)
            @foreach($data->item_group->where('student','') as $g)
            $('#group_item_button{{ $g->id }}').click(function () {
                $(".group_item{{ $g->id }}").each(function(){
                    $(this).prop("checked",true);
                })
            });
            $('#group_item_unbutton{{ $g->id }}').click(function () {
                $(".group_item{{ $g->id }}").each(function(){
                    $(this).prop("checked",false);
                })
            });
            @endforeach
            @else
            $('#group_item_button').click(function () {
                $("input[name='check_item[]']").each(function(){
                    $(this).prop("checked",true);
                })
            });
            $('#group_item_unbutton').click(function () {
                $("input[name='check_item[]']").each(function(){
                    $(this).prop("checked",false);
                })
            });
            @endif

            @if($data->item_data->where('student',\Illuminate\Support\Facades\Auth::user()->id)->count() > 0)
            @foreach($data->item_data->where('student',\Illuminate\Support\Facades\Auth::user()->id) as $d)
            $('#group_item_customer_button').click(function () {
                $(".group_item_customer").each(function(){
                    $(this).prop("checked",true);
                })
            });
            $('#group_item_customer_unbutton').click(function () {
                $(".group_item_customer").each(function(){
                    $(this).prop("checked",false);
                })
            });
            @endforeach
            @endif
        });
    </script>
@endpush
@section('content')
    @include('Frontplatform.layouts.alert')
    <div class="row div-content">
        <div class="col-12 pb-3">
            <div class="row">
                <div class="col-12 col-lg-5"><h1>功過格『{{ $data->name }}』</h1></div>
                <div class="col-12 col-lg-7 text-right" style="padding: 0">
                    <div class="row">
                        <div class="col-4 col-md-4 text-center" style="padding: 0"><a href="#add_custom" class="btn back_btn" data-toggle="modal">新增功課</a></div>
                        <div class="col-4 col-md-4 text-center" style="padding: 0"><a href="{{ route('merit.ration',['merit'=>$data]) }}" class="btn back_btn">評量表</a></div>
                        <div class="col-4 col-md-4 text-center" style="padding: 0"><a href="{{ route('merit.index') }}" class="btn back_btn">返回目錄</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <h2>{{ date('Y-m-d',strtotime($merit->created_at)) }}</h2>
        </div>
            <form class="col-12 select-div" action="{{ route('merit_update',['meritGrade'=>$merit->id]) }}" method="post">
                @csrf
                @if($data->item_group->count() > 0)
                    @foreach($data->item_group as $g)
                        <h4 class="mt-3">{{ $g->name }}
                            @if($loop->index > 7 && $data->name == '感應篇')
                                <span style="color: red">(打勾為“沒有違犯”)</span>
                                <button class="btn btn-primary " type="button" id="group_item_button{{ $g->id }}">沒有違犯</button>
                                <button class="btn btn-danger" type="button" id="group_item_unbutton{{ $g->id }}">有違犯</button>
                            @else
                                <button class="btn btn-primary" type="button" id="group_item_button{{ $g->id }}">做到</button>
                                <button class="btn btn-danger" type="button" id="group_item_unbutton{{ $g->id }}">沒做到</button>
                            @endif
                        </h4>
                        <div class="row">
                            @foreach($data->item_data->where('group',$g->id) as $d)
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input group_item{{ $g->id }}" name="check_item[]" value="{{ $d->id }}" {{ strpos($merit->yes,strval($d->id)) !== false ? "checked":"" }}> <span>{{ $d->item }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @else
                    <button class="btn btn-primary" type="button" id="group_item_button">做到</button> <button class="btn btn-danger" type="button" id="group_item_unbutton">沒做到</button>
                    <div class="row">
                        @foreach($data->item_data->where('student','') as $d)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="check_item[]" value="{{ $d->id }}" {{ strpos($merit->yes,strval($d->id)) !== false ? "checked":"" }}> {{ $d->item }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($data->item_data->where('student',\Illuminate\Support\Facades\Auth::user()->id)->count() > 0)
                    <h4 class="mt-3">自我作業 <button class="btn btn-primary" type="button" id="group_item_customer_button">做到</button> <button class="btn btn-danger" type="button" id="group_item_customer_unbutton">沒做到</button></h4>
                    <div class="row">
                        @foreach($data->item_data->where('student',\Illuminate\Support\Facades\Auth::user()->id) as $d)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input group_item_customer" name="check_item[]" value="{{ $d->id }}" {{ strpos($merit->yes,strval($d->id)) !== false ? "checked":"" }}> {{ $d->item }}<a href="#delete_custom{{ $d->id }}" data-toggle="modal" style="color: #ef0d0c"><i class="fas fa-trash-alt"></i></a>
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="d-flex flex-wrap justify-content-center pt-3">
                    <div class="p-2">
                        <button type="submit" class="btn done_btn">修改</button>
                    </div>
                    <div class="p-2">
                        <button type="reset" class="btn done_btn">重填</button>
                    </div>
                </div>
            </form>
    </div>
    @include('Frontplatform.modals.merit_content_add')
    @include('Frontplatform.modals.merit_edit_delete')
@endsection
