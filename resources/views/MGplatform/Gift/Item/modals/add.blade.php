<!-- The Modal -->
<div class="modal" id="add">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('gift_item.store') }}" method="post">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">新增</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">名稱：</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">送出</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>

        </form>
    </div>
</div>
