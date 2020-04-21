@foreach($data->item_data as $i)
<!-- The Modal -->
<div class="modal" id="edit{{ $i->id }}">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('merit_item_MG.update',['merit_item_MG'=>$i]) }}" method="post">
        @method('PATCH')
        @csrf
        <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">修改</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="item">項目:</label>
                    <input type="text" class="form-control" id="item" name="item" value="{{ $i->item }}">
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">更新</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>

        </form>
    </div>
</div>
@endforeach
