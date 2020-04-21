@foreach($data as $d)
    <!-- The Modal -->
    <div class="modal" id="delete{{ $d->id }}">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('indexImage.destroy',['indexImage'=>$d]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">刪除圖片</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h4>確定刪除此圖片？</h4>
                    <img src="{{ asset('storage/index_img/'.$d->img) }}">
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
