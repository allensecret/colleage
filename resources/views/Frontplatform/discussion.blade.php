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

        .item_btn{
            font-family: 'DFXingShuStd-W5';
            font-size: 1.2rem;
            margin-right: 1.2rem;
            padding: 0px 15px 0px 15px;
            border-radius: 15px;
            border: none;
            background-color: rgb(247,245,241);
            color: black;
        }

        .item_btn:hover{
            background-color: rgb(213,209,205);
        }

        .item_btn.active{
            background-color: rgb(213,209,205);
        }

        .menu_btn{
            font-size: 1.1rem;
            padding: 0px 30px 0px 30px;
            border-radius: 15px;
            border: none;
            background-color: rgb(213,209,205);
            color: black;
        }

        .dropdown-item{
            font-size: 1.1rem;
        }

        a{
            color: black;
        }
        a:hover{
            color: black;
            text-decoration:none;
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

        @if($s_type == '')
            tbody tr:nth-child({{ $news->count() }}) {
                border-bottom: 5px rgb(255,255,255) solid;
            }
        @endif

        .time-text{
            font-size: 0.4rem;
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

            .time-text{
                font-size: 0.8rem;
            }

            @if($s_type == '')
                tbody tr:nth-child({{ $news->count() }}) {
                    border-bottom: 0px rgb(255,255,255) solid;
                }

                @foreach($news as $n)
                tbody tr:nth-child({{ $loop->iteration }}) > td:nth-child(2) , tr:nth-child({{ $loop->iteration }}) > td:nth-child(4) {
                    display: none;
                }
                @endforeach
            @endif
        }
    </style>
@endpush
@section('content')
    @include('Frontplatform.layouts.alert')
<div class="row div-content">
    <div class="col-12 pt-4 pb-3">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1 style="font-family:S5YQSM;">討論版</h1>
            </div>
            <form class="col-12 col-md-6 text-right" action="{{ route('discussion.index') }}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="文章標題" name="search" value="{{ old('search') }}">
                    <div class="input-group-append">
                        <button class="btn push_btn" type="submit">搜尋</button>
                    </div>

                </div>
                <input type="hidden" value="{{ $s_type }}" name="type">
            </form>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-around flex-wrap">
        <div class="p-2"><a href="{{ route('discussion.index') }}" class="btn item_btn {{ $s_type == '' ? 'active':'' }}">全部主題</a></div>
        @foreach($type as $t)
            <div class="p-2"><a href="{{ route('discussion.index',['type'=>$t->id]) }}" class="btn item_btn {{ $s_type == $t->id ? 'active':'' }}">{{ $t->type }}</a></div>
        @endforeach
    </div>
    <div class="col-12 pt-3 text-right">
        <div class="d-flex justify-content-between">
            <div class="p-2">
                @if(empty(\Illuminate\Support\Facades\Auth::user()->black))
                    <a href="{{ route('discussion.create') }}" class="btn push_btn">發帖</a>
                @endif
                    <a href="{{ route('discussion_personal.index') }}" class="btn push_btn">
                        個人帖子清單
                    </a>
            </div>
            <div class="p-2">
                <button type="button" class="btn button dropdown-toggle menu_btn font-DFXing" data-toggle="dropdown">
                    @if(isset($sort) || $sort == 'last')
                        最後發表
                    @else
                        全部時間
                    @endif
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('discussion.index',['type'=> $s_type]) }}">全部時間</a>
                    <a class="dropdown-item" href="{{ route('discussion.index',['type'=> $s_type,'sort'=>'last']) }}">最後發表</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 pt-3 pb-3">
        <table>
            <thead>
                <tr>
                    <th scope="col" style="width: 70%">主題</th>
                    <th scope="col" style="width: 5%">回覆</th>
                    <th scope="col" style="width: 15%">發表者</th>
                    <th scope="col" style="width: 10%">最新回應</th>
                </tr>
            </thead>
            <tbody>
            @if($s_type == '')
                @foreach($news as $n)
                <tr>
                    <td data-label="主題：">
                        <div style="margin-left: 3rem">
                            <a href="{{ route('news.show',['news'=>$n]) }}">【{{ $n->type_name->name }}】{{ $n->title }}</a>
                        </div>
                    </td>
                    <td data-label="回覆：" style="text-align: center">0</td>
                    <td data-label="發表者：">佛陀教育網路學院<br><span class="time-text" >{{ $n->created_at }}</span></td>
                    <td data-label="最新回應："></td>
                </tr>
                @endforeach
            @endif

            @foreach($list as $l)
                <tr>
                    <td data-label="主題：">
                        <div style="margin-left: 3rem">
                            <a href="{{ route('discussion.show',['discussion'=>$l,'type'=>$s_type]) }}">【{{ $l->type_name->type }}】{{ $l->title }}</a>
                        </div>
                    </td>
                    <td data-label="回覆：" style="text-align: center">{{ $l->replies->count() }}</td>
                    <td data-label="發表者：">{{ $l->student_name->account }}<br><span class="time-text" >{{ date('Y-m-d',strtotime($l->created_at)) }}</span></td>
                    <td data-label="最新回應：">{{ $l->get_last_student['account'] }}<br><span class="time-text">{{ count($l->replies) != 0 ? date('Y-m-d',strtotime($l->replies->last()['created_at'])):"" }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $list->links() }}
    </div>
</div>
@include('Frontplatform.modals.discussion_delete')
@endsection
