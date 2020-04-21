<!-- The Modal -->
<div class="modal" id="add">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('merit_item_MG.store',['merit'=>$data->id]) }}" method="post">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">新增</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                @if(count($list_group) > 0)
                <div class="form-group">
                    <label for="group">群組:</label>
                    <select class="form-control" id="group" name="group">
                        @foreach($list_group as $l)
                            <option value="{{ $l->id }}">{{ $l->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <label for="item">項目:</label>
                    <input type="text" class="form-control" id="item" name="item">
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
