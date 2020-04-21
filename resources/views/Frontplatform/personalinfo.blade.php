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
    </style>
@endpush

@section('content')
    @include('Frontplatform.layouts.alert')
    <div class="row div-content">
        <div class="col-12 pb-4">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="pl-5">
                    <h1 style="font-family:S5PZEX;">個人資料預覽</h1>
                </div>
                <div class="pr-5">
                    <a href="{{ route('personalInfo.edit',['personalInfo'=>$data->id]) }}" class="btn report_btn" style="font-size: 1.7rem">修改</a>
                </div>
            </div>
        </div>
        <div class="col-12 pb-5">
            <div class="row">
                <div class="col-12 col-lg-6 input_div_l">
                    <div class="form-group">
                        <label for="name">姓名：</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="gender">性別：</label>
                        <input type="text" class="form-control" id="job" name="job" value="{{ $data->data->gender }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="job">職業：</label>
                        <input type="text" class="form-control" id="job" name="job" value="{{ $data->data->job }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="phone">電話：</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->data->phone }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">地址：</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $data->data->address }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="volunteer">義工意願：</label>
                        <input type="text" class="form-control" id="volunteer" name="volunteer" value="{{ $data->data->volunteer }}" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-6 input_div_r">
                    <div class="form-group">
                        <label for="dharma_name">法號：</label>
                        <input type="text" class="form-control" id="dharma_name" name="dharma_name" value="{{ $data->data->dharma_name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="birthday">出生 年/月/日：</label>
                        <input type="text" class="form-control" id="birthday" name="birthday" value="{{ date('Y/m/d',strtotime($data->data->birthday)) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="language">語言：</label>
                        <input type="text" class="form-control" id="language" name="language" value="{{ $data->data->language }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nationality">國籍：</label>
                        <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $data->data->nationality }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">電子郵件：</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="skill">專長學歷：</label>
                        <input type="text" class="form-control" id="skill" name="skill" value="{{ $data->data->skill }}" readonly>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
