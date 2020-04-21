@foreach($bulletin->get_replies as $replies)
    <!-- The Modal -->
    <div class="modal" id="delete{{ $v->id }}">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('delete_relies',['replies'=>$replies]) }}" method="POST">
            @method('DELETE')
            @csrf
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">刪除</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h2>確定刪除此留言？</h2>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">刪除</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
