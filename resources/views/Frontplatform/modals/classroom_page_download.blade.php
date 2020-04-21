@foreach(Auth::user()->curriculas as $c)
<!-- The Modal -->
<div class="modal fade" id="page_download{{ $c->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="border-bottom:0px">
                <h2 class="modal-title font_DGX">講義下載</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- 其他學生的心得分享 -->
            <!-- Modal body -->
            <div class="modal-body ml-3 mr-3">
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#pdf">PDF</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#doc">WORD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#txt">TXT</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @foreach(['pdf','doc','txt'] as $type)
                        <div id="{{ $type }}" class="container tab-pane {{ $type == 'pdf' ? "active":"" }}"><br>
                            <div class="row">
                                @foreach($c->course->coursedata->resources()->where('type',$type)->get() as $r )
                                    <div class="col-4 col-lg-2 pb-3">
                                        <a href="{{ $host_attr->resource_attr.$r->attr }}" class="btn dl_btn">第{{ $r->ep }}集</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer" style="border-top:0px">
            </div>
        </div>
    </div>
</div>
@endforeach
