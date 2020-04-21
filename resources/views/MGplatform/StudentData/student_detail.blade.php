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
    @include('MGplatform.layouts.alert')
    <div class="row align-items-stretch">
        <div class="col-2 text-left">
            <a href="{{ url()->previous() }}" class="btn btn-primary">返回</a>
        </div>
        <div class="col-8 text-center">
            <h1>{{ $data->account }}_{{ $data->name }}</h1>
        </div>
        <div class="col-2 text-right">
            @can('data.update')
            <a href="{{ route('data.edit',['data'=>$data]) }}" class="btn btn-primary">編輯</a>
            @endcan
        </div>
        <div class="col-12 m-3" style="font-size: 1.3rem">
            <div class="row">
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">學號：</div>
                        <div class="col-8">{{ $data->account }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">姓名：</div>
                        <div class="col-8">{{ $data->name }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">法號：</div>
                        <div class="col-8">{{ $data->data->dharma_name }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">性別：</div>
                        <div class="col-8">{{ $data->data->gender }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">國籍：</div>
                        <div class="col-8">{{ $data->data->nationality }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">E-Mail：</div>
                        <div class="col-8">{{ $data->email }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">電話：</div>
                        <div class="col-8">{{ $data->data->phone }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">行動電話：</div>
                        <div class="col-8">{{ $data->data->cellphone }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">生日：</div>
                        <div class="col-8">{{ $data->data->birthday }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">地址：</div>
                        <div class="col-8">{{ $data->data->address }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">語言：</div>
                        <div class="col-8">{{ $data->data->language }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">傳真：</div>
                        <div class="col-8">{{ $data->data->fax }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">職業：</div>
                        <div class="col-8">{{ $data->data->job }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">技能：</div>
                        <div class="col-8">{{ $data->data->skill }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">義工：</div>
                        <div class="col-8">{{ $data->data->Volunteer }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">黑名單狀態：</div>
                        <div class="col-8"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">申請日期：</div>
                        <div class="col-8">{{ $data->created_at }}</div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pt-3">
                    <div class="row">
                        <div class="col-4">更新日期：</div>
                        <div class="col-8">{{ $data->updated_at }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
