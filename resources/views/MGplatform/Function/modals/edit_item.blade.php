@foreach($feature->item as $i)
<!-- The Modal -->
<div class="modal" id="edit_{{ $i->id }}">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('features_item_update',['item'=>$i]) }}" method="post">
        @method('PATCH')
        @csrf
        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">修改細項</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="item">細項：</label>
                    <input type="text" class="form-control" id="item" name="item" value="{{ $i->item }}">
                </div>
                <div class="form-group">
                    <label for="email">資料名稱：</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $i->name }}">
                </div>
                <div class="form-check-inline">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="review_edit" name="option[]" value="review" {{ strstr($i->option,'review') ? "checked":"" }}>
                        <label class="custom-control-label" for="review_edit">預覽</label>
                    </div>
                </div>
                <div class="form-check-inline">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="edit_edit" name="option[]" value="edit" {{ strstr($i->option,'edit') ? "checked":"" }}>
                        <label class="custom-control-label" for="edit_edit">編輯</label>
                    </div>
                </div>
                <div class="form-check-inline">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="delete_edit" name="option[]" value="delete" {{ strstr($i->option,'delete') ? "checked":"" }}>
                        <label class="custom-control-label" for="delete_edit">刪除</label>
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
@endforeach
