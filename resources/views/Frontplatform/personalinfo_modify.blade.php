@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .form-group {
            padding-bottom: 30px;
        }

        .form-control {
            background-color: rgb(247, 245, 241);
            border: rgb(229, 225, 221);
        }

        .form-control:focus {
            background-color: rgb(247, 245, 241);
        }

        .custom-select{
            background-color: rgb(247, 245, 241);
            border: rgb(229, 225, 221);
        }

        .submit_btn {
            margin-right: 1.2rem;
            padding: 5px 100px 5px 100px;
            border-radius: 10px;
            border: none;
            background-color: rgb(213, 209, 204);
            color: #000000;
        }

        .submit_btn:hover{
            background-color: rgb(144,143,141);
            color: white;
        }

        .go_classromm{
            margin-right: 1.2rem;
            padding: 5px 100px 5px 100px;
            border-radius: 10px;
            border: none;
            background-color: rgb(213, 209, 204);
            color: #000000;
        }
        .go_classromm:hover{
            background-color: rgb(144,143,141);
            color: white;
        }

        .star_mark:before{
            font-size: 1.2rem;
            color: #ef0d0c;
            content: "*";
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            @if(session('modal_status') == 'on')
            $('#myModal').modal('show');
            @endif

            $('#volunteer_job').change(function () {
                console.log($(this).val());
                if($(this).val() != "請選擇意願"){
                    if($('#volunteer').val() == ""){
                        if($(this).val() == "其他(自行敘述)"){
                            $('#volunteer').val("其他(在此輸入)");
                        }else{
                            $('#volunteer').val($(this).val());
                        }
                    }else{
                        if($(this).val() == "其他(自行敘述)"){
                            $('#volunteer').val($('#volunteer').val()+";"+"其他(在此輸入)");
                        }else{
                            $('#volunteer').val($('#volunteer').val()+";"+$(this).val());
                        }
                    }
                }

            });

            $('#birthday').datepicker({
                format: 'yyyy/mm/dd',
                showRightIcon: false,
                uiLibrary: 'bootstrap4'
            });
        });
    </script>
@endpush
@section('content')
    @include('Frontplatform.layouts.alert')
    <div class="row div-content">
        <div class="col-12 pb-4">

            <div class="d-flex justify-content-between flex-wrap">
                <div class="pl-5">
                    <h1><a href="{{ route('personalInfo.index') }}" style="color: rgb(154, 164, 170);"><i class="fas fa-angle-left"></i></a> 修改個人資料</h1>
                    <span style="color: #ef0d0c"><span class="star_mark"></span> 為必填欄位</span>
                </div>
            </div>
        </div>
        <div class="col-12 pb-5">
            <form class="row" action="{{ route('personalInfo.update',['personalInfo'=>$personalInfo]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="col-12 col-md-6 col-lg-6 input_div_l">
                    <div class="form-group">
                        <label for="name"><span class="star_mark"></span>姓名：</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $personalInfo->name }}" required>
                        <div>{{ $errors->first('name') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="gender"><span class="star_mark"></span>性別：</label>
                        <select class="custom-select" id="gender" name="gender" required style="background-color: rgb(247, 245, 241)">
                            <option {{ $personalInfo->data->gender == "請輸入性別" }}>請選擇性別</option>
                            <option {{ $personalInfo->data->gender == '男' ? "selected":"" }} selected>男</option>
                            <option {{ $personalInfo->data->gender == '女' ? "selected":"" }}>女</option>
                        </select>
                        <div class="errors_div">{{ $errors->first('gender') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="job">職業：</label>
                        <input type="text" class="form-control" id="job" name="job" value="{{ $personalInfo->data->job }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">電話：</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $personalInfo->data->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="address"><span class="star_mark"></span>地址：</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $personalInfo->data->address }}" required>
                    </div>

                    <label for="volunteer">義工意願：</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="volunteer" name="volunteer" placeholder="義工項目">
                        <div class="input-group-append">
                            <select class="form-control" id="volunteer_job">
                                <option>請選擇意願</option>
                                <option>文稿整理</option>
                                <option>程式語言</option>
                                <option>影音剪輯</option>
                                <option>美工設計</option>
                                <option>雜誌書籍排版</option>
                                <option>其他(自行敘述)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6 input_div_r">
                    <div class="form-group">
                        <label for="dharma_name">法號：</label>
                        <input type="text" class="form-control" id="dharma_name" name="dharma_name" value="{{ $personalInfo->data->dharma_name }}">
                    </div>
                    <div class="form-group">
                        <label for="birthday"><span class="star_mark"></span>出生 年/月/日：</label>
                        <input type="text" class="form-control" id="birthday" name="birthday" value="{{ date('Y/m/d',strtotime($personalInfo->data->birthday)) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="language"><span class="star_mark"></span>語言：</label>
                        <input type="text" class="form-control" id="language" name="language" value="{{ $personalInfo->data->language }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nationality"><span class="star_mark"></span>國籍：</label>
                        <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $personalInfo->data->nationality }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><span class="star_mark"></span>電子郵件：</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $personalInfo->email }}" required>
                        <div>{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="skill">專長學歷：</label>
                        <input type="text" class="form-control" id="skill" name="skill" value="{{ $personalInfo->data->skill }}">
                    </div>
                </div>

                <div class="col-12 col-lg-6 input_div_l text-center pb-3">
                    <button type="submit" class="btn submit_btn">送出</button>
                </div>
                <div class="col-12 col-lg-6 input_div_r text-center pb-3">
                    <button type="reset" class="btn submit_btn">重填</button>
                </div>
            </form>
        </div>
    </div>
@endsection
