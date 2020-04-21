@foreach($resources as $r)
<!-- The Modal -->
<div class="modal" id="edit{{ $r->id }}">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('scripture.update',['scripture'=>$r]) }}" method="post">
            @method('PATCH')
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">修改檔案資源</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="class">班級：</label>
                        <select class="form-control" id="class" name="course">
                            @foreach($level as $l)
                                <option value="{{ $l->id }}" {{ $l->id == $r->course ? "selected":"" }}>{{ $l->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">標題：</label>
                        <input type="text" class="form-control" id="title" name="name" value="{{ $r->name }}">
                    </div>
                    <div class="form-group">
                        <label for="url">連結：</label>
                        <input type="text" class="form-control" id="url" name="attr" value="{{ $r->attr }}">
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">送出</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>
            </form>
        </form>
    </div>
</div>
@endforeach
