@foreach($data as $d)
<!-- The Modal -->
<div class="modal" id="edit{{ $d->id }}">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('merit_MG.update',['merit_MG'=>$d]) }}" method="post" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">增加項目</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">名稱：</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $d->name }}">
                </div>

                <h5>圖片：</h5>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="file">
                    <label class="custom-file-label" for="customFile">{{ $d->img }}</label>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">送出</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">關閉</button>
            </div>

        </form>
    </div>
</div>
@endforeach
