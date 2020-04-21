@foreach($data as $d)
<!-- The Modal -->
<div class="modal" id="update{{ $d->id }}">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('indexImage.update',['indexImage'=>$d]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">變更圖片</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h4>圖片：</h4>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="image">
                    <label class="custom-file-label" for="customFile">{{ $d->img }}</label>
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
