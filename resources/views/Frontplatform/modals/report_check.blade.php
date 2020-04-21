@foreach(Auth::user()->curriculas as $c)
<!-- The Modal -->
<div class="modal fade" id="check{{$c->id}}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header ml-3 mr-3">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- 其他學生的心得分享 -->
            <!-- Modal body -->
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-start pb-5">
                    <div class="p-2 "><h2 class="font-DFXing">{{ $c->course->coursedata->title }}</h2></div>
                    <div class="p-2 "><h3>{{ $c->grade }}</h3></div>
                </div>
                <div class="row pb-5">
                    <div class="col-12" style="font-size: 1.3rem">報告內容</div>
                    <div class="col-12 pt-3" style="padding: 10px 4em 10px 4em">
                        {!! $c->content  !!}
                    </div>
                </div>
                <div class="row pb-5">
                    @if($c->respond != null)
                        <div class="col-12" style="font-size: 1.3rem">老師回應</div>
                        <div class="col-12 pt-3" style="padding: 10px 4em 10px 4em">
                            {!! $c->respond  !!}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer" style="border-top:0px">
            </div>

        </div>
    </div>
</div>
@endforeach
