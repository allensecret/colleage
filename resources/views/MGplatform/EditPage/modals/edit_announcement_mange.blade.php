<div class="modal" id="myModal">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('edit_announcement_mange',['config'=>$config]) }}" method="post">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">通知管理</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body text-center" style="font-size: 1.3rem">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="config" value="1" {{ $config->config == 1 ? "checked":"" }}>開啟
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="config" value="0" {{ $config->config == 0 ? "checked":"" }}>關閉
                    </label>
                </div>
            </div>
            {{ csrf_field() }}
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">送出</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>

        </form>
    </div>
</div>
