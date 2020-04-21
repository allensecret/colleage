<!-- The Modal -->
<div class="modal" id="black_list_add">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('black_list.store') }}" method="post">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="col-12 modal-title text-center">添加黑名單學員<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="student_id" style="font-size: 1.3rem">學號:</label>
                    <input type="text" class="form-control" id="account" name="account">
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
