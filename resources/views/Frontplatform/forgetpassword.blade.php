@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .student_id_form{
            padding-left: 200px;
            padding-right: 200px;
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

        .form-control {
            background-color: rgb(247, 245, 241);
            border: rgb(229, 225, 221);
        }

        .form-control:focus {
            background-color: rgb(247, 245, 241);
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

        @media only screen and (max-width: 991px) {
            .student_id_form{
                padding-left: 10px;
                padding-right: 10px;
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            @if (session('email'))
                $("#success").modal();
            @endif
        });
    </script>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12">
            <h1>忘記密碼</h1>
            <form class="student_id_form pt-3" action="{{ route('forget_password_send') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="student_email" style="font-size: 1.3rem">請輸入您目前的學號(或是基本資料內所留的E-Mail),送出後將會寄帳號與密碼至您基本資料所留的Email</label>
                    <input type="email" class="form-control" id="student_email" name="student_email">
                </div>
                <div style="color: red">{{ $errors->first('student_email') }}</div>
                <div class="text-center">
                    <button type="submit" class="btn submit_btn">送出</button>
                </div>

            </form>
        </div>
    </div>
    @include('Frontplatform.modals.forget_password_success')

@endsection
