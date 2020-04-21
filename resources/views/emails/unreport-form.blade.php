@extends('emails.layouts.layout')
@section('content')
    <tr>
        <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
            <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">{{ $data['sn_course'] }} {{ $data['course'] }} 未提交報告信件</h1>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                同學您好您好：<br>
            </p>

            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                您尚有{{ $data['sn_course'] }} {{ $data['course'] }}課程，未提交修學報告。本年度課程將在３月底結束，若不能如期在３月２０日前完成修學報告，將無法在本年度中升級。<br>
                特此通知！
            </p>

            @include('emails.layouts.signature')

        </td>
    </tr>
@endsection
