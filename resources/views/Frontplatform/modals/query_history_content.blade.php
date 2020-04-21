@foreach($curriculas as $c)
<!-- The Modal -->
<div class="modal" id="report{{ $c->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >

            <!-- Modal Header -->
            <div class="modal-header" style="padding: 5px 10px 0px 0px">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="p-2 "><h2 class="font-DFXing">{{ $c->course->coursedata->title }}</h2></div>
                    <div class="p-2 "><h3>{{ $c->grade }}</h3></div>
                </div>
                <p style="padding-left:2rem">報告內容：</p>
                <div style="padding-left: 4em;">{!! $c->content !!}</div>
                <p style="padding-left:2rem ">老師回應：</p>
                <div style="padding-left: 4em;">{!! $c->respond !!}</div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            </div>

        </div>
    </div>
</div>
@endforeach
