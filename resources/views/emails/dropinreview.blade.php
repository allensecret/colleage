@extends('emails.layouts.layout')
@section('content')
    <!-- Body content --><tr>
        <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
            <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">復學信件</h1>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                南無阿彌陀佛！
            </p>

            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                同學您好：<br>
                您提出的復學申請已經正式通過，您的學生識別證號已經改回為：{{ $data['account'] }} ，密碼無變動。請妥善保管您的識別證號及密碼。<br>
                若要登入學院網頁，請使用此新的學號，休學期間所使用的暫用學號已經廢除。
            </p>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 24px; line-height: 1.5em; margin-top: 0; text-align: left;">
                在學習中若有任何疑問，可在討論版中提出，歡迎共同學習！<br>
                祝您　學習愉快！
            </p>

            @include('emails.layouts.signature')

        </td>
    </tr>
@endsection



