@foreach($report as $r)
<!-- The Modal -->
<div class="modal" id="report{{ $r->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">報告內容</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h5>課程：{{ $r->course->coursedata->sn }}  {{ $r->course->coursedata->title }}</h5>
                <h5>學生：{{ $r->get_student->account }}</h5>
                <h5>內容：</h5>
                <div class="card">
                    <div class="card-body" style="color: #1b1e21">{!! $r->content!!}</div>
                </div>
                <h5 class="pt-3">評語：</h5>
                <div class="card">
                    <div class="card-body" style="color: #1b1e21">{!! $r->respond !!}</div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer form-inline">
                @if($r->grade == "A" || $r->grade == "B" || $r->grade == "C")
                <a href="{{ route('shear_report',['report'=>$r]) }}" class="btn btn-info">分享至欣賞修學</a>
                @endif
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>
@endforeach
