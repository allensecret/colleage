@foreach($data as $v)
    <!-- The Modal -->
    <div class="modal" id="personal{{ $v->get_student->id }}">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('UnReport_mail',['student'=>$v->get_student->account,'course'=>$v->course->coursedata->title,'sn_course'=>$v->course->coursedata->sn]) }}" method="POST">
            @csrf
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">通知信件</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="font-size: 1.5rem;color:red">
                    將通知"{{$v->get_student->account}}"此學生繳交報告信件！
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">送出</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
