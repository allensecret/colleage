@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function() {
            $('li[name=student_li]').addClass('active');
            $('div[name=student]').addClass('show');
        });
    </script>
@endpush

@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">學生管理</li>
        <li class="breadcrumb-item text_label">學生資料</li>
    </ol>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="row align-items-stretch" action="{{ route('data.update',['data'=>$data]) }}" method="POST">
        @method('PATCH')
        @csrf
        <div class="col-2 text-left">
            <a href="{{ $_SERVER["HTTP_REFERER"] }}" class="btn btn-primary">返回</a>
        </div>
        <div class="col-8 text-center">
            <h1>{{ $data->account }}_{{ $data->name }}</h1>
        </div>
        <div class="col-2 text-right">
            <button type="submit" class="btn btn-primary">儲存</button>
        </div>
        <div class="col-12 p-3" style="font-size: 1.3rem">
            <div class="row">
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">學號：</div>
                        <div class="col-8"><input type="text" class="form-control" id="student_id" name="student_id" value="{{ $data->account }}" disabled></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">姓名：</div>
                        <div class="col-8"><input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}"></div>
                        <div style="color: #ef0d0c">{{ $errors->first('name') }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">法號：</div>
                        <div class="col-8"><input type="text" class="form-control" id="dharma_name" name="dharma_name" value="{{ $data->data->dharma_name }}"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">性別：</div>
                        <div class="col-8">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" value="男" {{ $data->data->gender == "男" ? "checked":"" }}>男
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" value="女" {{ $data->data->gender == "女" ? "checked":"" }}>女
                                </label>
                            </div>
                        </div>
                        <div style="color: #ef0d0c">{{ $errors->first('gender') }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">國籍：</div>
                        <div class="col-8"><input type="text" class="form-control" id="nationality" name="nationality" value="{{ $data->data->nationality }}"></div>
                        <div style="color: #ef0d0c">{{ $errors->first('nationality') }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">E-Mail：</div>
                        <div class="col-8"><input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}"></div>
                        <div style="color: #ef0d0c">{{ $errors->first('email') }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">電話：</div>
                        <div class="col-8"><input type="tel" class="form-control" id="phone" name="phone" value="{{ $data->data->phone }}"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">行動電話：</div>
                        <div class="col-8"><input type="tel" class="form-control" id="cellphone" name="cellphone" value="{{ $data->data->cellphone }}"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">生日：</div>
                        <div class="col-8"><input type="date" class="form-control" id="birthday" name="birthday" value="{{ $data->data->birthday }}"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">地址：</div>
                        <div class="col-8"><input type="text" class="form-control" id="address" name="address" value="{{ $data->data->address }}"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">語言：</div>
                        <div class="col-8"><input type="text" class="form-control" id="language" name="language" value="{{ $data->data->language }}"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">傳真：</div>
                        <div class="col-8"><input type="text" class="form-control" id="fax" name="fax" value="{{ $data->data->fax }}"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">職業：</div>
                        <div class="col-8"><input type="text" class="form-control" id="job" name="job" value="{{ $data->data->job }}"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">技能：</div>
                        <div class="col-8"><input type="text" class="form-control" id="skill" name="skill" value="{{ $data->data->skill }}"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">義工：</div>
                        <div class="col-8"><input type="text" class="form-control" id="Volunteer" name="Volunteer" value="{{ $data->data->volunteer }}"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">黑名單狀態：</div>
                        <div class="col-8">
                            <div class="col-8">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="black" value="1" ><i class="fas fa-check" style="color: green"></i>
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="black" value="0" checked><i class="fas fa-times" style="color:red;"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
