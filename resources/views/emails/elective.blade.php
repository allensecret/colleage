@extends('emails.layouts.layout')
@section('content')
    <!-- Body content -->
    <tr>
        <td class="content-cell"
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
            <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">
                選課通知</h1>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                {{ $data['name'] }}您好：<br>
                阿彌陀佛！
            </p>

            <div class="table" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                <table
                    style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 30px auto; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                    <thead style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                    <tr>
                        <th style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; border-bottom: 1px solid #edeff2; padding-bottom: 8px;">
                            課程編號
                        </th>
                        <th style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; border-bottom: 1px solid #edeff2; padding-bottom: 8px;">
                            課程
                        </th>
                        <th style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; border-bottom: 1px solid #edeff2; padding-bottom: 8px;">
                            授課老師
                        </th>
                        <th style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; border-bottom: 1px solid #edeff2; padding-bottom: 8px;">
                            修別
                        </th>
                        <th style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; border-bottom: 1px solid #edeff2; padding-bottom: 8px;">
                            備註
                        </th>
                    </tr>
                    </thead>
                    <tbody style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                    @foreach($curricula as $c)
                        <tr>
                            <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ $c->course->coursedata->sn }}</td>
                            <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ $c->course->coursedata->title }}</td>
                            <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ $c->course->coursedata->teacher }}</td>
                            <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ $c->course->compulsory == 1 ? "必修":"選修" }}</td>
                            <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 15px; line-height: 18px; padding: 10px 0;">{{ $c->course->remark }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @include('emails.layouts.signature')

        </td>
    </tr>
@endsection
