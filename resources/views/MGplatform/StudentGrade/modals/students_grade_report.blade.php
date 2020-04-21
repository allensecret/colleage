@foreach($data->curriculas as $c)
    <!-- The Modal -->
    <div class="modal" id="work_report{{ $c->id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">報告內容</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="d-flex">
                        <div class="p-2 flex-fill">編號：{{ $c->course->coursedata->sn }}</div>
                        <div class="p-2 flex-fill">標題：{{ $c->course->coursedata->title }}</div>
                        <div class="p-2 flex-fill">評分：{{ $c->grade }}</div>
                        <div class="p-2 flex-fill">繳交時間：{{ date('Y-m-d',strtotime($c->report_date)) }}</div>
                    </div>
                    <div class="card">
                        報告：
                        <div class="card-body" style="color: #1b1e21">{!! $c->content !!}</div>
                    </div>
                    <div class="card mt-3">
                        評語：
                        <div class="card-body" style="color: #1b1e21">{!! $c->respond !!}</div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer form-inline">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
