<!-- The Modal -->
<div class="modal" id="login">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background-color: rgb(246, 244, 239)">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            {{--{{ route('ST.login') }}--}}
            <form class="modal-body" action="{{ route('ST.login') }}" method="post">
                @csrf
                <div class="container pt-3 pb-5">
                    <h1 class="text-center">
                        <img src="/img/new_frontplatform/Logo.png" class="login-modal-logo" style="width: 50%;height: 50%">
                    </h1>
                    <div class="form-group modal-login-input">
                        <input type="text" class="form-control form-control-lg" style="border: 0px" name="account" placeholder="學號：" required autofocus>

                    </div>
                    <div class="form-group modal-login-input">
                        <input type="password" class="form-control form-control-lg" style="border: 0px" name="password" placeholder="密碼：">
                    </div>
                    <div class="form-group modal-login-input">
                        <button type="submit" class="btn btn-block" style="border-radius: 15px;background-color:#cfcbc6;font-size: 1.3em">登入</button>
                    </div>
                    <div class="d-flex justify-content-around">
                        <div class="p-2" style="font-size: 1.1em">
                            <label class="form-check-label" for="remember_me">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                記住我
                            </label>
                        </div>
                        <div class="p-2" style="font-size: 1.1em"><a href="{{ route('forget_password') }}" style="text-decoration: none;color: black;line-height: 50px">忘記密碼</a> </div>
                    </div>
                    <div class="text-center" style="color: red;font-size: 1.3rem">{{ $errors->first('account') }}</div>
                </div>
            </form>

            <!-- Modal footer -->
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
