@extends('emails.layouts.layout')
@section('content')
    <tr>
        <td class="content-cell"
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
            <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">
                復學信件</h1>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                阿彌陀佛！
            </p>

            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                您好：<br>
                您提出復學申請的資料已經收訖，尚須等待受理完成後才會正式復學，正式復學時會寄E-Mail到您的信箱中通知您。
            </p>

            @include('emails.layouts.signature')

        </td>
    </tr>
@endsection


