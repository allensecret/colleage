@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .nav-pills .nav-item a{
            font-size: 1.5rem;
        }

        .nav-pills .nav-item{
            padding-right: 50px;
            padding-left: 50px;
        }
        .nav-pills .nav-item .nav-link{
            padding-top: 0px;
            padding-bottom: 0px;
            background-color: rgb(207,203,197);
            border-radius: 15px;
            color: white;
        }
        .nav-pills .nav-item .active{
            border-radius: 15px;
            background-color: rgb(144,143,141);
        }

        .list_text li{
            font-size: 1rem;
            padding-bottom: 5px;
        }

        .div-list{
            padding: 50px 50px 0px 50px;
        }

        .list_text{
            border-radius: 15px;
            padding: 20px 20px 30px 20px;
            list-style-type:none;
            background-color: rgb(246,244,239);
        }

        .list_text .title-list{
            font-size: 1.5rem;
            padding-bottom: 15px;
        }

    </style>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12 text-left">
            <h1 style="font-family:S5MMRE;">教材下載</h1>
        </div>
        <div class="col-12 pt-4">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link {{ $s_course == 1 ? 'active':'' }}" href="{{ route('material_download.index',['course'=>1]) }}">基礎班</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $s_course == 2 ? 'active':'' }}" href="{{ route('material_download.index',['course'=>2]) }}">本科班</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $s_course == 3 ? 'active':'' }}" href="{{ route('material_download.index',['course'=>3]) }}">專科班</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <div class="row">
                        <div class="col-12 col-lg-4 div-list">
                            <ul class="list_text">
                                <li class="text-center title-list">經本區</li>
                                @foreach($data->where('type',1) as $d)
{{--                                    <li><a href="{{ route('material_download.show',['material_download'=>$d]) }}">- {{ $d->name }}</a></li>--}}
                                    <li><a href="{{ $d->attr }}">- {{ $d->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-12 col-lg-4 div-list">
                            <ul class="list_text">
                                <li class="text-center title-list">教材區</li>
                                @foreach($data->where('type',2) as $d)
{{--                                    <li><a href="{{ route('material_download.show',['material_download'=>$d]) }}">- {{ $d->name }}</a></li>--}}
                                    <li><a href="{{ $d->attr }}">- {{ $d->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
