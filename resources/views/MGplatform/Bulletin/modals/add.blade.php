@if(!empty($type))
    <!-- The Modal -->
    <div class="modal" id="add">
        <div class="modal-dialog modal-xl">
            <form class="modal-content" action="{{ route('bulletin.store') }}" method="post">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">新增公告消息</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form>
                    <!-- Modal body -->
                    <div class="modal-body" style="font-size: 1.3rem">
                        <div class="form-group">
                            <label for="type">公告類型：</label>
                            <select class="form-control" id="type" name="type">
                                @foreach($type as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">標題:</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="announcement_content">內容:</label>
                            <textarea class="announcement_content" id="announcement_content" name="content"></textarea>
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
@endif
