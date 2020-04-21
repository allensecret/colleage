@extends('Frontplatform.layouts.layout')
@push('style')
    <style>
        .button {
            /*margin-right: 1.2rem;*/
            padding: 0px 30px 0px 30px;
            border-radius: 15px;
            border: none;
            background-color: rgb(213, 209, 204);
            color: black;
        }

        .button:hover{
            color: white;
            background-color: rgb(143,154,160);
        }

        .relative1 {
            position: relative;
            margin: 0 auto;
            top: -150px;
            width: 200px;
            height: 200px;
            border-radius: 10px;
            box-shadow: 4px 4px 5px -1px rgba(20%, 20%, 40%, 0.1);
        }

        .relative2 {
            position: relative;
            margin: 0 auto;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-color: rgb(247, 245, 241);
            width: 200px;
            height: 300px;
            border-radius: 10px;
            z-index: 1;
        }

        .relative2:hover{
            cursor:pointer;
        }

        .card-div{
            height: 400px;
        }

        .text{
            position: absolute;
            width: 100%;
            bottom: 10px;
            display: flex;
            margin: auto;
        }

        .text-p{
            margin: auto; /* Important */
            text-align: center;
        }

        .modal-img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }
        .slide-box{
            display: -webkit-box;
            overflow-x: scroll;
            -webkit-overflow-scrolling:touch;
        }

        .slide-box::-webkit-scrollbar {
            display: none;
        }



        /*@media only screen and (max-width: 500px) {*/
            /**/

        /*}*/

        @media only screen and (min-width: 415px) and (max-width: 1024px) {
            .button {
                /*margin-right: 1.2rem;*/
                padding: 0px 20px 0px 20px;
                border-radius: 15px;
                border: none;
                background-color: rgb(213, 209, 204);
                color: black;
            }


            .relative1 {
                position: relative;
                margin: 0 auto;
                top: -150px;
                width: 150px;
                height: 200px;
                border-radius: 10px;
                box-shadow: 4px 4px 5px -1px rgba(20%, 20%, 40%, 0.1);
            }

            .relative2 {
                position: relative;
                margin: 0 auto;
                background-repeat: no-repeat;
                background-size: 150px 200px;
                background-position: center;
                background-color: rgb(247, 245, 241);
                width: 150px;
                height: 200px;
                border-radius: 10px;
                z-index: 1;
            }

            .ps:before{
                font-family: "FontAwesome";
                content: "p.s 向右滑動 \f105";
            }

        }

        @media only screen and (max-width: 415px) {
            .button {
                /*margin-right: 1.2rem;*/
                padding: 0px 20px 0px 20px;
                border-radius: 15px;
                border: none;
                background-color: rgb(213, 209, 204);
                color: black;
            }


            .relative1 {
                position: relative;
                margin: 0 auto;
                top: -150px;
                width: 120px;
                height: 190px;
                border-radius: 10px;
                box-shadow: 4px 4px 5px -1px rgba(20%, 20%, 40%, 0.1);
            }

            .relative2 {
                position: relative;
                margin: 0 auto;
                background-repeat: no-repeat;
                background-size: 120px 180px;
                background-position: center;
                background-color: rgb(247, 245, 241);
                width: 120px;
                height: 180px;
                border-radius: 10px;
                z-index: 1;
            }

            .ps:before{
                font-family: "FontAwesome";
                content: "p.s 向右滑動 \f105";
            }

        }


    </style>
@endpush
@section('content')
    <div class="row div-content">
        <div class="col-12 pb-3">
            <h1 style="font-family:S5LBRY;">佛陀教育雜誌</h1>
        </div>
        <div class="col-12 pb-3">
            <div class="d-flex slide-box">
                @for($i=date('Y');$i >= 2019;$i--)
                    <div class="p-2">
                        <a href="{{ route('magazine.index',['year'=>$i]) }}" class="btn button">{{ $i }}</a>
                    </div>
                @endfor
            </div>
            <span class="ps"></span>
        </div>
        <div class="d-flex justify-content-around flex-wrap">
            @foreach($data as $d)
                <div class="p-2 card-div">
                    <div class="relative2" onclick="location.href='{{ route('magazine.show',['magazine' => $d]) }}'" style="background-image: url('/storage/magazine_img/{{ $d->image }}')"></div>
                    <div class="relative1" style="background-color: white;">
                        <div class="text">
                            <p class="text-p">{{ $d->id }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
{{--    @include('Frontplatform.modals.magazine_intro')--}}
@endsection



