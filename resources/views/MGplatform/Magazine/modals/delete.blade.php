<!-- The Modal -->
<div class="modal" id="delete">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="{{ route('magazineMG.destroy',['magazineMG'=>$magazineMG]) }}" method="post" enctype="multipart/form-data">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">刪除</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body text-center">
                @method('DELETE')
                @csrf
                <h3>確定刪除第{{ $magazineMG->id }}期別雜誌？</h3>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="d-flex justify-content-around">
                    <div class="p-2">
                        <button type="submit" class="btn btn-success">確認刪除</button>
                    </div>
                    <div class="p-2">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                    </div>
                </div>

            </div>

        </form>
    </div>
</div>
