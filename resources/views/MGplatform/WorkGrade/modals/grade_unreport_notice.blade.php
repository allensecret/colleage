<!-- The Modal -->
<div class="modal" id="unreport_notice">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('UnReport_all_mail',['data'=>$s_curricula]) }}" method="POST">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">通知信件</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="font-size: 1.5rem;color:red">
                將通知此課程學生繳交報告信件！
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">送出</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>
        </form>
    </div>
</div>
