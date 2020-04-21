@foreach($discussionMG->replies as $r)
<!-- The Modal -->
<div class="modal" id="delete_replies">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('discussionMG_delete_replies',['discussionMG'=>$r]) }}">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">刪除留言</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                確定刪除此留言？
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">刪除</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>

        </form>
    </div>
</div>
@endforeach