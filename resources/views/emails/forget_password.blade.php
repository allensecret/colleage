@extends('emails.layouts.layout')
@section('content')
    <!-- Body content -->
    <tr>
        <td class="content-cell"
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                {{ $data->data->email }}您好：<br>
                阿彌陀佛！
            </p>

            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                您的學號為：{{ $data['account'] }}<br>
                您的密碼為：amtbamtb<br>
                <span style="color: red;font-size: 1.2rem">此密碼為<b>暫時性密碼</b> 登入後請盡快更改密碼確保安全性</span><br>
                <br>
                請妥善保管您的密碼，因為這是您使用「學生中心」的識別資料，沒有輸入此識別資料，您將無法進入聽課、參與網路心得研討、提交修學報告及修改查詢個人學籍資料。<br>
                若對網路修學有任何不清楚之處，請再至「新生入學」處詳細了解其說明，或寫信給我們 amtb@amtb.org.tw 。<br>
                關於修課須知或升級問題，請至此「學生修學須知」處了解其說明，或是經由 首頁>學生中心>學生修學須知 進入參考。<br>
            </p>

            @include('emails.layouts.signature')

        </td>
    </tr>
@endsection



