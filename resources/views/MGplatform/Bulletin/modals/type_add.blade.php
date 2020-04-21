<!-- The Modal -->
<div class="modal" id="type_add">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('create_type') }}" method="POST">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">新增公告類型</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type">類型:</label>
                        <input type="text" class="form-control" id="type" name="name">
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
