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
            font-size: 1.3rem;
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

        .nav_div{
            font-size: 1.3rem;
        }

        .star_mark:before{
            font-size: 1.2rem;
            color: #ef0d0c;
            content: "*";
        }

        .description_title{

        }

        .description_content{
            font-size: 1.1rem;
            padding:15px 2em 0px 2em
        }

        .input_div_l label{
            font-size: 1.2rem;
        }
        .input_div_r label{
            font-size: 1.2rem;
        }

        .errors_div{
            color: red;
        }
        @media only screen and (min-width: 415px) and (max-width: 1024px) {
            .nav_div{
                font-size: 1.1rem;
            }

            .star_mark:before{
                font-size: 1.1rem;
                color: #ef0d0c;
                content: "*";
            }

            .description_title{
                font-size: 1.2rem;
            }

            .description_content{
                font-size: 1rem;
                padding:15px 2em 0px 2em
            }

            .submit_btn {
                margin-right: 1.2rem;
                padding: 5px 50px 5px 50px;
                border-radius: 10px;
                border: none;
                background-color: rgb(213, 209, 204);
                color: #000000;
            }

            .input_div_l label{
                font-size: 1.1rem;
            }
            .input_div_r label{
                font-size: 1.1rem;
            }
        }

        @media only screen and (max-width: 415px) {
            .nav_div{
                font-size: 1rem;
                padding-bottom: 1rem;
            }

            .star_mark:before{
                font-size: 1rem;
                color: #ef0d0c;
                content: "*";
            }
            .description_title{
                font-size: 1.2rem;
            }

            .description_content{
                font-size: 1rem;
                padding:15px 1em 0px 1em
            }

            .submit_btn {
                margin-right: 0.8rem;
                padding: 5px 30px 5px 30px;
                border-radius: 10px;
                border: none;
                background-color: rgb(213, 209, 204);
                color: #000000;
            }

            .input_div_l label{
                font-size: 1rem;
            }
            .input_div_r label{
                font-size: 1rem;
            }
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
                if($('#volunteer').val() == ""){
                    $('#volunteer').val($(this).val());
                }else{
                    $('#volunteer').val($('#volunteer').val()+";"+$(this).val());
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
    <div class="row div-content">
        <div class="col-12">
            <div class="d-flex justify-content-center flex-wrap text-center nav_div">
                <div class="p-2">
                    <a class="guide_link font-DFXing " href="{{ route('guide') }}" style="font-family:S5KFMM;">入學指導</a><span class="divider"></span>
                </div>
                @if(!\Illuminate\Support\Facades\Auth::check())
                <div class="p-2">
                    <a class="guide_link font-DFXing active" href="{{ route('registration.index') }}" style="font-family:S5DUZF;">註冊報名</a><span class="divider"></span>
                </div>
                @endif
                <div class="p-2">
                    <a class="guide_link font-DFXing" href="{{ route('course_introduction') }}" style="font-family:S5JUVK;">課程介紹</a><span class="divider"></span>
                </div>
                <div class="p-2">
                    <a class="guide_link font-DFXing" href="{{ route('calendar') }}" style="font-family:S5DSSU;">年度行事曆</a>
                </div>
            </div>
        </div>

        <div class="col-12 pb-4">
            <h1 style="font-family:S5DUZF;">報名註冊</h1>
            <span style="color: #ef0d0c"><span class="star_mark"></span> 為必填欄位</span>
        </div>
        <div class="col-12 pb-5">
            <form class="row" action="{{ route('registration.store') }}" method="post">
                @csrf
                <div class="col-12 col-md-6 col-lg-6 input_div_l">
                    <div class="form-group">
                        <label for="name"><span class="star_mark"></span>姓名：</label>
                        <input type="text" class="form-control" id="name" name="r_name">
                        <div class="errors_div">{{ $errors->first('r_name') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="gender"><span class="star_mark"></span>性別：</label>
                        <select class="custom-select" id="gender" name="r_gender">
                            <option>男</option>
                            <option>女</option>
                        </select>
                        <div class="errors_div">{{ $errors->first('r_gender') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="job">職業：</label>
                        <input type="text" class="form-control" id="job" name="r_job">
                    </div>
                    <div class="form-group">
                        <label for="phone">電話：</label>
                        <input type="text" class="form-control" id="phone" name="r_phone">
                    </div>
                    <div class="form-group">
                        <label for="address"><span class="star_mark"></span>地址：</label>
                        <input type="text" class="form-control" id="address" name="r_address">
                        <div class="errors_div">{{ $errors->first('r_address') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="password"><span class="star_mark"></span>密碼：</label>
                        <input type="password" class="form-control" id="password" name="r_password">
                        <div class="errors_div">{{ $errors->first('r_password') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="check_password"><span class="star_mark"></span>確認密碼：</label>
                        <input type="password" class="form-control" id="check_password" name="r_check_password">
                        <div class="errors_div">{{ $errors->first('r_check_password') }}</div>
                    </div>
                </div>


                <div class="col-12 col-md-6 col-lg-6 input_div_r">
                    <div class="form-group">
                        <label for="dharma_name">法號：</label>
                        <input type="text" class="form-control" id="dharma_name" name="r_dharma_name">
                    </div>
                    <div class="form-group">
                        <label for="birthday">出生 年/月/日：</label>
                        <input type="text" class="form-control" id="birthday" name="r_birthday" placeholder="年/月/日">
                    </div>
                    <div class="form-group">
                        <label for="language"><span class="star_mark"></span>語言：</label>
                        <input type="text" class="form-control" id="language" name="r_language">
                        <div class="errors_div">{{ $errors->first('r_language') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="nationality"><span class="star_mark"></span>國籍：</label>
                        <input type="text" class="form-control" id="nationality" name="r_nationality">
                        <div class="errors_div">{{ $errors->first('r_nationality') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="email"><span class="star_mark"></span>電子郵件：</label>
                        <input type="email" class="form-control" id="email" name="r_email">
                        <div class="errors_div">{{ $errors->first('r_email') }} {{ $errors->first('email_fail') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="skill">專長學歷：</label>
                        <input type="text" class="form-control" id="skill" name="r_skill">
                    </div>
                    <label for="volunteer">義工意願：</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="volunteer" name="r_volunteer" placeholder="義工項目">
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
                <div class="col-12 declaration_div pt-3">
                    <h2 class="description_title">聲明事項</h2>
                    <p  class="description_content">若您考量後，確實能依照網路學院規定的做到，再填報名表，我們收到資料後會發一封信給正式學員，
                        並告知一個識別的學號及密碼。此學號及密碼，將使用在「學生中心」中，請務必妥善保管您的密碼。 這是您使用「學生中心」的識別資料，沒有輸入此識別資料，您將無法進入聽課、參與網路心得研討、
                        提交修學報告及修改查詢個人學籍資料。報名表中的所有內容，將會保密，不會對外公布，亦不做其 他用途。</p>
                </div>
                <div class="col-6 col-lg-6 text-center pb-3">
                    <button type="submit" class="btn submit_btn">送出</button>
                </div>
                <div class="col-6 col-lg-6 text-center pb-3">
                    <button type="reset" class="btn submit_btn">重填</button>
                </div>
            </form>
        </div>
    </div>
    @include('Frontplatform.modals.registration_modals')
@endsection
