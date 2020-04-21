<!-- The Modal -->
<div class="modal" id="add">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('scripture.store') }}" method="post">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">新增檔案資源</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="class">班級：</label>
                    <select class="form-control" id="class" name="course">
                        @foreach($level as $l)
                            <option value="{{ $l->id }}" {{ $l->id == $type ? "selected":"" }}>{{ $l->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">標題：</label>
                    <input type="text" class="form-control" id="title" name="name">
                </div>
                <div class="form-group">
                    <label for="url">連結：</label>
                    <input type="text" class="form-control" id="url" name="attr">
                </div>
                <input type="hidden" value="1" name="type">
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">送出</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>
        </form>
    </div>
</div>
