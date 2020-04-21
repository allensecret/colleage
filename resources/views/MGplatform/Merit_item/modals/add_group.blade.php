<!-- The Modal -->
<div class="modal" id="add_group">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('merit_item_MG.add_group',['merit'=>$data->id]) }}" method="post">
        @csrf
        <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">新增群組</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="group">名稱:</label>
                    <input type="text" class="form-control" id="group" name="group">
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">新增</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>

        </form>
    </div>
</div>
