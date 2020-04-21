@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .push_btn{
            font-size: 1.3rem;
            padding: 0px 30px 0px 30px;
            border-radius: 10px;
            border: none;
            background-color: rgb(154, 164, 170);
            color: #ffffff;
        }

        table {
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table thead tr{
            background-color:rgb(247,245,241);
            font-size: 1.3rem;
            text-align: left;
        }

        thead tr th:first-child{
            border-radius: 10px 0px 0px 0px;
            padding-left: 80px;
        }

        thead tr th:last-child{
            border-radius: 0px 10px 0px 0px;
        }

        tbody tr:last-child td:first-child{
            border-radius: 0px 0px 0px 10px;
        }
        tbody tr:last-child td:last-child{
            border-radius: 0px 0px 10px 0px
        }

        tbody{
            background-color: rgb(252,251,248);
            font-size: 1.1rem;
        }

        table th,
        table td {
            padding: .625em;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 700px) {
            table {
                border: 0;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
                border-radius: 10px;
                background-color: rgb(252,251,248);
                box-shadow:10px 10px 20px -7px rgba(20%,20%,40%,0.5);
            }

            tbody tr td:first-child{
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: 1.1rem;
                text-align: left;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: 1.1rem;
                text-align: right;
            }

            table td::before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }

        }
    </style>
@endpush
@section('content')
    @include('Frontplatform.layouts.alert')
    <div class="row div-content">
        <div class="col-12 pt-4 pb-3">
            <div class="row">
                <div class="col-6 col-md-6">
                    <h1><a href="{{ route('discussion.index') }}" style="color: rgb(154, 164, 170);"><i class="fas fa-angle-left"></i></a> 討論版-個人文章管理</h1>
                </div>
                <form class="col-6 col-md-6 text-right" action="{{ route('discussion_personal.index') }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="文章標題" name="search" value="{{ old('search') }}">
                        <div class="input-group-append">
                            <button class="btn push_btn" type="submit">搜尋</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12 pt-3 pb-3">
            <ul class="nav nav-pills nav-justified pb-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $type == 1 ? "active":"" }}" href="{{ route('discussion_personal.index',['type'=>1]) }}">帖子</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $type == 2 ? "active":"" }}" href="{{ route('discussion_personal.index',['type'=>2]) }}">回覆</a>
                </li>
            </ul>

            <table >
                <thead>
                <tr>
                    <th scope="col" style="width: 70%">主題</th>
                    <th scope="col" style="width: 5%">回覆</th>
                    <th scope="col" style="width: 15%">發表者</th>
                    <th scope="col" style="width: 10%">最新回應</th>
                </tr>
                </thead>
                <tbody>
                @if($type == 1)
                    @foreach($list as $l)
                        <tr>
                            <td data-label="主題：">
                                <div style="margin-left: 3rem">
                                    <a href="{{ route('discussion.show',['discussion'=>$l,'type'=>$l->type]) }}" target="view_window">【{{ $l->type_name->type }}】{{ $l->title }}</a>
                                </div>
                            </td>
                            <td data-label="回覆：" style="text-align: center">{{ $l->replies->count() }}</td>
                            <td data-label="發表者：">{{ $l->student_name->account }}<br><span style="font-size: 0.4rem;">{{ date('Y-m-d',strtotime($l->created_at)) }}</span></td>
                            <td data-label="最新回應：">{{ $l->get_last_student['account'] }}<br><span style="font-size: 0.4rem;">{{ count($l->replies) != 0 ? date('Y-m-d',strtotime($l->replies->last()['created_at'])):"" }}</span></td>

                        </tr>
                    @endforeach
                @else
                    @foreach($list as $l)
                        <tr>
                            <td data-label="主題：">
                                <div style="margin-left: 3rem">
                                    <a href="{{ route('discussion.show',['discussion'=>$l->get_post,'type'=>$l->get_post->type]) }}" target="view_window">【{{ $l->get_post->type_name->type }}】{{ $l->get_post->title }}</a>
                                </div>
                            </td>
                            <td data-label="回覆：" style="text-align: center">{{ $l->get_post->replies->count() }}</td>
                            <td data-label="發表者：">{{ $l->get_post->student_name->account }}<br><span style="font-size: 0.4rem;">{{ date('Y-m-d',strtotime($l->get_post->created_at)) }}</span></td>
                            <td data-label="最新回應：">{{ $l->get_post->get_last_student['account'] }}<br><span style="font-size: 0.4rem;">{{ count($l->get_post->replies) != 0 ? date('Y-m-d',strtotime($l->get_post->replies->last()['created_at'])):"" }}</span></td>

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{ $list->links() }}
        </div>
    </div>
@endsection
