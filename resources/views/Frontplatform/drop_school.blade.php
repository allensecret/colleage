@extends('Frontplatform.layouts.layout')
@push('style')
    <style>

        table{
            font-size: 1.1rem;
            line-height: 40px;
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

        .form-control{
            border-radius: 10px;
            border: none;
            background-color: rgb(246,244,239);
        }

        .form-control:focus{
            background-color: rgb(246,244,239);
        }

        .submit_btn{
            font-family: 'DFXingShuStd-W5';
            font-size: 1.6rem;
            margin-right: 1.2rem;
            padding: 0px 120px 0px 120px;
            border-radius: 10px;
            border: none;
            background-color: rgb(207,203,197);
            color: #ffffff;
        }

        .submit_btn:hover{
            color: white;
            background-color: rgb(143,154,160);
        }

        .modal-content{
            border: none;
            background-color: rgb(246,244,239);
        }

        @media only screen and (max-width: 991px) {
            .div-content{
                margin:0px 0px 30px 0px;
            }
        }
    </style>
@endpush
@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->drop_status->where('term',0)->count() == 0)
    <form class="row div-content" action="{{ route('drop_school.store',['item'=> $data->stay_in_school == 1 ? 1:2]) }}" method="post">
        @csrf
        <div class="col-12 pb-5 ">
            <h1 style="font-family: {{ $data->stay_in_school == 1 ? "S5ISKE":"S5RFVE" }}">申請{{ $data->stay_in_school == 1 ? "休學":"復學"}}</h1>
        </div>
        <div class="col-12 text-center" style="font-size: 1.1rem">
            <div class="row pb-4">
                <div class="col-3 text-right">一、相關法規：</div>
                <div class="col-9 text-left"></div>
            </div>
            <div class="row pb-4">
                <div class="col-3 text-right">二、承辦單位：</div>
                <div class="col-9 text-left">註冊組</div>
            </div>
            <div class="row pb-4">
                <div class="col-3 text-right">三、辦理時間：</div>
                <div class="col-9 text-left">辦理時間:註冊後申請休學，至遲須於學期提交修學報告開始前一周為之。<br>但如因病或重要事故，則可隨時提出申請休學，需詳述原因，或附相關證明。</div>
            </div>
            <div class="row pb-4">
                <div class="col-3 text-right">四、注意事項：</div>
                <div class="col-9 text-left">學生休學，以一學期、一學年或二學年為期，休學累計以二學年為原則。 <br>期滿因重病或特殊事故需再申請休學者，應經教務處之核可後，酌予延長休學年限， </br>但至多以二學年為限。有任何疑問請寫信至amtb@amtb.org.tw詢問。</div>
            </div>
            @if($data->stay_in_school == 1)
            <div class="row pb-4">
                <div class="col-3 text-right">申請期限：</div>
                <div class="col-9 text-left">
                    <select class="form-control" id="sel1" name="drop_year">
                        <option value="1">一年</option>
                        <option value="2">二年</option>
                        <option value="3">三年</option>
                        <option value="4">四年</option>
                        <option value="5">五年</option>
                    </select>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-3 text-right">{{ $data->stay_in_school == 1 ? "休學":"復學"}}原因：</div>
                <div class="col-9 text-left">
                    <textarea name="reason"></textarea>
                </div>
                <div>{{ $errors->first('reason') }}</div>
            </div>
            <div class="row pt-5">
                <div class="col-12 col-lg-6 pb-3"><button class="btn submit_btn" type="submit">送出</button></div>
                <div class="col-12 col-lg-6 pb-3"><button class="btn submit_btn" type="reset">重填</button></div>
            </div>

        </div>
    </form>
    @else
        <div class="row div-content">
            <div class="col-12 text-center pt-5 pb-5">
                <h1>將會對您的申請進行審核，後續將會由信件通知。</h1>
            </div>
        </div>
    @endif
    @include('Frontplatform.modals.drop_school_notifi')
@endsection
