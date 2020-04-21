    <!-- The Modal -->
    <div class="modal" id="delete">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ route('discussion.destroy',['discussion'=>$discussion]) }}" method="post">
            @csrf
            @method('DELETE')
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">刪除帖子</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="p-2">
                            <h2 style="color: #ef0d0c">確定刪除此篇帖子?將會刪除以下留言</h2>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn report_btn">送出</button>
                </div>

            </form>
        </div>
    </div>
