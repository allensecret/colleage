@extends('emails.layouts.layout')
@section('content')
    <!-- Body content -->
    <tr>
        <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
            <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">降級信件</h1>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                阿彌陀佛！
            </p>

            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                同學您好<br>
                經學院考核評估，您需要穩固基礎，萬丈高樓平地起，若基本功扎實，在往後的經論學習中方能得心應手。因此，將您的學號從{{ $data['old_student_id'] }}降為 {{ $data['new_student_id'] }} ，從基礎開始，夯實基礎，再求發展。<br>
                若有任何疑問請寫信至<a href="mailto:amtb@amtb.tw">amtb@amtb.tw</a>信箱詢問。
            </p>

            @include('emails.layouts.signature')

        </td>
    </tr>
@endsection



