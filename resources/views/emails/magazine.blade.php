@extends('emails.layouts.layout')
@section('content')
    <!-- Body content -->
    <tr>
        <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
            <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">【佛陀教育雜誌】Vol.{{ $data['id'] }}</h1>

            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                尊敬的佛陀教育雜誌訂戶，您好：<br>
                本期發送【佛陀教育雜誌】Vol.{{ $data['id'] }} {{ date('Y') }}.{{ date('m') }}<br>
            </p>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                {!! $data['intro'] !!}
            </p>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                ＊閱讀雜誌內容：請開啟此封信附加PDF檔案。<br>
                ＊若無法閱讀，請點：<a href="https://new.amtbcollege.org/magazine_download/{{ $data['id'] }}?type=Traditional">https://new.amtbcollege.org/magazine_download/{{ $data['id'] }}?type=Traditional</a><br>
                ＊簡化字版，請點：<a href="https://new.amtbcollege.org/magazine_download/{{ $data['id'] }}?type=Simplified">https://new.amtbcollege.org/magazine_download/{{ $data['id'] }}?type=Simplified</a><br>
                ＊若有問題，敬請來信聯絡：<a href="mailto:amtb@amtb.tw">amtb@amtb.tw</a>
            </p>
            @include('emails.layouts.signature')

        </td>
    </tr>
@endsection



