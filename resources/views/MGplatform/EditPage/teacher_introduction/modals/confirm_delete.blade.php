@foreach($teacher as $v)
<!-- The Modal -->
<div class="modal" id="delete{{ $v->id }}">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('teacher_introduction.destroy',['teacher_introduction'=>$v]) }}" method="post">
            @csrf
            @method('DELETE')
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">刪除</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body text-center">
                確定刪除！？{{ $v->name }}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">確認</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>

        </form>
    </div>
</div>
@endforeach
