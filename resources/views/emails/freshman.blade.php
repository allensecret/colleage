@extends('emails.layouts.layout')
@section('content')
    <!-- Body content --><tr>
        <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
            <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">新生入學信件</h1>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                阿彌陀佛！
            </p>

            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                您好：<br>
                歡迎您加入「佛陀教育網路學院」學習。這是您的學號：{{ $new_student_id }} ，密碼：{{ $data['r_password'] }}。請妥善保管您的識別證號及密碼。這是進入網路學院聽課、提交修學報告的唯一憑證。
                請先熟悉<a href="http://www.amtbcollege.org/">http://www.amtbcollege.org/</a>　學院網頁中的各項功能，若有疑問可登入學號後在「討論版」中提出，或是寫信至 <a href="mailto:amtb@amtb.tw">amtb@amtb.tw</a>信箱詢問。
                人身難得，佛法難聞，得人身聞佛法，這是人生之一大幸事，望把握此難得之因緣，集積功德，福慧增上，業障消除！
                敬請常念　　南無阿彌陀佛，消業障，增福慧！　　　　　　
                <a href="https://wwww.amtbcollege.org" class="button button-blue" target="_blank" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #ffffff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #3097d1; border-top: 10px solid #3097d1; border-right: 18px solid #3097d1; border-bottom: 10px solid #3097d1; border-left: 18px solid #3097d1;">上課去</a>
            </p>

            @include('emails.layouts.signature')

        </td>
    </tr>
@endsection


