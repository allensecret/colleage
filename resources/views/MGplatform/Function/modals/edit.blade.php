@foreach($data as $d)
<!-- The Modal -->
<div class="modal" id="edit_{{ $d->id }}">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('features.update',['feature'=>$d]) }}" method="post">
        @method('PATCH')
        @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">修改項目</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="email">項目：</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $d->name }}">
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
