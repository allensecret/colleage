<!-- The Modal -->
<div class="modal" id="auto_elective_course">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">選課開放管理</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('sup_elective.update',['sup_elective'=>$config->id]) }}" method="POST">
                @method('PATCH')
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="config" name="config" value="1" {{ $config->config == 1 ? "checked":"" }}>
                        <label class="custom-control-label" for="config">開放</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="config2" name="config" value="0" {{ $config->config == 0 ? "checked":"" }}>
                        <label class="custom-control-label" for="config2">關閉</label>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">送出</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>
