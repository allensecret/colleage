@extends('MGplatform.layouts.layout')
@push('style')
    <style>
        .relative1 {
            position: relative;
            margin: 0 auto;
            top: -150px;
            width: 200px;
            height: 200px;
            border-radius: 10px;
            box-shadow: 4px 4px 5px -1px rgba(20%, 20%, 40%, 0.1);
            background-color: white;
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

        .custom-file-input:lang(en) ~ .custom-file-label::after {
            content: "檔案";
        }
    </style>
@endpush
@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=magazine_li]').addClass('active');

            $('#comment').summernote({
                tabsize: 3,
                height: 400
            });

            $("#year").change(function () {
                $("#term_form").submit();
            });

            $('#year').children().each(function () {
                if($(this).val() == "{{ $year }}"){
                    $(this).attr("selected", true);
                }
            });
        });
    </script>
@endpush
@section('navbar')
    <h3>雜誌管理</h3>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <form class="form-inline" action="{{ route('magazineMG.index') }}" id="term_form" name="term_form">
                        <label for="level">年度：</label>
                        <select class="form-control" id="year" name="year">
                            @for($i=date('Y');$i>=2019;$i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </form>
                </div>
                <div class="col-4">
                    @can('magazine.view')
                        <a href="{{ route('magazineMG.create') }}" class="btn btn-success float-right">新增雜誌</a>
                    @endcan
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-around flex-wrap">
                        @foreach($data as $d)
                            <div class="p-2 card-div">
                                <div class="relative2" onclick="location.href='{{ route('magazineMG.show',['magazineMG' => $d]) }}'" style="background-image: url('/storage/magazine_img/{{ $d->image }}');"></div>
                                <div class="relative1">
                                    <div class="text">
                                        <p class="text-p">{{ $d->id }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
    </div>
@endsection
