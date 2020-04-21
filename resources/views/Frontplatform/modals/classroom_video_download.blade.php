@foreach(Auth::user()->curriculas as $c)
<!-- The Modal -->
<div class="modal fade" id="vide_download{{ $c->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="border-bottom:0px">
                <h2 class="modal-title font-DFXing">影音下載</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- 其他學生的心得分享 -->
            <!-- Modal body -->
            <div class="modal-body ml-3 mr-3">
                <div class="container tab-pane "><br>
                    <div class="row">
                        @foreach($c->course->coursedata->get_media as $m)
                            <div class="col-4 col-lg-2 pb-3"><a href="{{ $host_attr->attr.$m->attr }}" class="btn dl_btn">第{{ $m->ep }}集</a></div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer" style="border-top:0px">
            </div>

        </div>
    </div>
</div>

@endforeach
