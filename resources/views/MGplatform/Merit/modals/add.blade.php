<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('merit_MG.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">增加項目</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" style="font-size: 1.25rem">名稱：</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <h5>圖片：</h5>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="file">
                    <label class="custom-file-label" for="customFile"></label>
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
