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

@push('scripts')
    <script>
        $(document).ready(function () {
            @if(\Session::has('modal'))
                $("#myModal").modal();
            @endif
        });
    </script>
@endpush

@section('content')
    <div class="row div-content">
        <div class="col-12 pb-4">
            <div class="d-flex justify-content-between">
                <div class="pl-5">
                    <h1 style="font-family:S5LELA;">更改密碼</h1>
                </div>
            </div>
        </div>
        <div class="col-12 pb-5">
            <div class="d-flex justify-content-center">
                <form class="p-5 flex-fill" action="{{ route('changePassword.update',['changePassword'=>$data]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="account">學號:</label>
                        <input type="text" class="form-control" id="account" name="account" value="{{ $data->account }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="new_pwd">新密碼：</label>
                        <input type="password" class="form-control" id="new_pwd" name="new_pwd">
                        @if ($errors->any())
                            <div style="color: red">{{ $errors->first('new_pwd') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="cnf_new_pwd">確認密碼：</label>
                        <input type="password" class="form-control" id="cnf_new_pwd" name="cnf_new_pwd">
                        @if ($errors->any())
                            <div style="color: red">{{ $errors->first('cnf_new_pwd') }}</div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="p-2">
                            <button type="submit" class="btn report_btn">修改</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @include('Frontplatform.modals.changepassword_cnf')
@endsection
