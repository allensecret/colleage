@extends('emails.layouts.layout')
@section('content')
    <!-- Body content --><tr>
        <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
            <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">{{ $data['sn'].'_'.$data['title'] }}  修學報告不及格者通知信件</h1>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                阿彌陀佛！
            </p>

            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                同學您好：<br>
                您的報告已審核，請登入<a href="http://www.amtbcollege.org/">http://www.amtbcollege.org/</a>「佛陀教育網路學院」查看報告審核後之評語，並依評語內容進行修改，並重新提交報告！<br>
                若有任何疑問，請在討論版中提出，或是寫信至<a href="mailto:amtb@amtb.tw">amtb@amtb.tw</a>信箱詢問。
            </p>

            @include('emails.layouts.signature')

        </td>
    </tr>
@endsection


