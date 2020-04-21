<!-- The Modal -->
<div class="modal" id="delete_select">
    <div class="modal-dialog">
        <form class="modal-content" action="" method="post">
        @csrf
        @method('DELETE')
        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">刪除主題</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                確定刪除此篇主題
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">刪除</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>

        </form>
    </div>
</div>