<!-- The Modal -->
<div class="modal" id="create">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('features_item_create',['feature'=>$feature]) }}" method="post">
        @csrf
        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">新建細項</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="item">細項：</label>
                    <input type="text" class="form-control" id="item" name="item">
                </div>
                <div class="form-group">
                    <label for="email">資料名稱：</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-check-inline">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="review_create" name="option[]" value="review">
                        <label class="custom-control-label" for="review_create">預覽</label>
                    </div>
                </div>
                <div class="form-check-inline">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="edit_create" name="option[]" value="edit">
                        <label class="custom-control-label" for="edit_create">編輯</label>
                    </div>
                </div>
                <div class="form-check-inline">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="delete_create" name="option[]" value="delete">
                        <label class="custom-control-label" for="delete_create">刪除</label>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">送出</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>

        </form>
    </div>
</div>
