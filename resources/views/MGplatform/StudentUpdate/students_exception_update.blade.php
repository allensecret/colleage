<!-- The Modal -->
<div class="modal" id="exception_update">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">流程外升降級</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('keyin_exception_update') }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">

                    <div class="form-group">
                        <label for="old_id">目前的學號(ex: ec00048):</label>
                        <input type="text" class="form-control" id="old_id" name="old_id">
                    </div>
                    <div class="form-group">
                        <label for="new_id">期望改成的學號(ex: eb00048) :</label>
                        <input type="text" class="form-control" id="new_id" name="new_id">
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
</div>
