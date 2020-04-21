@extends('MGplatform.layouts.layout')
@push('script')
<script>
    $(document).ready(function() {
        $('li[name=course_li]').addClass('active');
        $('div[name=course]').addClass('show');

        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endpush
@section('navbar')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">科目學分課程</li>
        <li class="breadcrumb-item text_label"><b>課程影音資料庫</b></li>
    </ol>
@endsection
@section('content')
    @include('MGplatform.layouts.alert')
    <div class="row align-items-stretch">
        <div class="col-12">
           <div class="row">
               <div class="col-4">
                   @can('course_data.create')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create"><i class="fa fa-calendar-plus-o"></i>新增課程資料</button>
                   @endcan
               </div>
               <div class="col-8">
                   <div class="form-inline float-right" >
                       <label for="search" class="mr-sm-2">搜尋：</label>
                       <input type="text" class="form-control mb-2 mr-sm-2" id="search" name="search" placeholder="編號/名稱/老師" size="30">
                   </div>
               </div>
               <div class="col-12" style="padding-top: 1%">
                   <table class="table table-striped" style="text-align: center">
                       <thead>
                           <tr>
                               <th>管理</th>
                               <th>課程編號</th>
                               <th>課程名稱</th>
                               <th>授課老師</th>
                               <th>集數</th>
                               <th>影音集</th>
                           </tr>
                       </thead>
                       <tbody id="myTable">
                       @foreach($data as $v)
                           <tr>
                               <td>
                                   @can('course_data.delete')
                                   <a href="#" data-toggle="modal" data-target="#delete{{ $v->id }}" style="color: red;font-size: 1.3rem"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;&nbsp;
                                   @endcan
                                   @can('course_data.update')
                                   <a href="#" data-toggle="modal" data-target="#edit{{ $v->id }}" style="color: blue;font-size: 1.3rem"><i class="fa fa-edit"></i></a>
                                   @endcan
                               </td>
                               <td>{{ $v->sn.$v->separation }}</td>
                               <td>{{ $v->title }}</td>
                               <td>{{ $v->teacher }}</td>
                               <td>{{ $v->ep }}</td>
                               <td>
                                   @can('course_data.view')
                                   <a href="{{ route('course_data.show',['course_datum'=> $v]) }}" style="color:blue;font-size:1.3rem"><i class="far fa-calendar-alt"></i></a>
                                   @endcan
                               </td>
                           </tr>
                       @endforeach
                       </tbody>
                   </table>
               </div>
           </div>
        </div>
    </div>
@endsection
@include('MGplatform.Course_data.modals.course_data_create')
@include('MGplatform.Course_data.modals.course_data_edit')
@include('MGplatform.Course_data.modals.course_data_delete')
