@extends('emails.layouts.layout')
@section('content')
    <tr>
        <td class="content-cell"
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
            <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">休學信件</h1>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                南無阿彌陀佛！
            </p>

            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                同學您好：<br>
                您提出休學的申請已經正式通過，您的學生識別證號已經更改為：{{ $data['account'] }} ，密碼無變動。請妥善保管您的識別證號及密碼。<br>
                若要登入學院網頁，申請書籍，或提出復學申請，都是使用此新學號，直到正式復學後，學號才會改回休學前原證號。<br>
                人身難得，佛法難聞，勿錯失此生得度之機緣，一失人身，難再復得，望珍重！常念南無阿彌陀佛，消業障，增福慧！<br>　　　　　　
                若有任何疑問請寫信至<a href="mailto:amtb@amtb.tw">amtb@amtb.tw</a>信箱詢問。
            </p>

            @include('emails.layouts.signature')

        </td>
    </tr>
@endsection


