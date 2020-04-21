@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .badge{
            font-size: 1rem;
        }

        li{
            font-size: 1.1rem;
        }

        .list-group{
            padding-left: 100px;
            padding-right: 100px;
        }

        .news_btn.active{
            color: white;
            background-color: rgb(154, 164, 170);
        }

        .news_font{
            font-size: 1.1rem;
        }

        @media only screen and (min-width: 426px) and (max-width: 1024px) {
            .news_font{
                font-size: 1rem;
            }
        }
        @media only screen and (max-width: 425px) {
            .news_font{
                font-size: 1rem;
            }
        }
    </style>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12 pb-3">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-6">
                    <h1 style="font-family:S5YWVG;">消息公告</h1>
                </div>
                <div class="col-12 col-md-8 col-lg-6 text-right" style="padding: 0">
                    <div class="d-flex">
                        @foreach($all_type as $t)
                        <div class="p-1 flex-fill"><a href="{{ route('news.index',['news_type'=>$t->id]) }}" class="btn news_btn {{ $t->id == $type ? "active":"" }}" style="font-family: @switch($t->name) @case('學院公告')S5MQSV @break @case('活動公告')S5EPXS @break @case('課程公告')S5POIH @break @endswitch">{{ $t->name }}</a></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 pb-3">
            @forelse($news_list as $n)
                <div class="row news_font pb-5">
                    <div class="col-5 text-center" style="padding: 0">{{ date('Y-m-d',strtotime($n->created_at)) }}</div>
                    <div class="col-7 text-left" style="padding: 0"><a href="{{ route('news.show',['news'=>$n]) }}">{{ $n->title }}</a></div>
                </div>
            @empty
                <div class="d-flex justify-content-around">
                    <div class="p-2">
                        無消息
                    </div>
                </div>
            @endforelse
        </div>

        {{ $news_list->links() }}
    </div>
@endsection
