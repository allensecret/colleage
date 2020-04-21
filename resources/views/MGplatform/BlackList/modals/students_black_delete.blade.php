@foreach($data as $v)
<!-- The Modal -->
<div class="modal" id="black_list_delete{{ $v->id }}">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('black_list.destroy',['black_list'=>$v]) }}" method="POST">
            @method('delete')
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="col-12 modal-title text-center">刪除黑名單學員<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p style="font-size: 1.5rem">確定刪除 "{{ $v->get_student->account }}" 黑名單項目？</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">送出</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>

        </form>
    </div>
</div>
@endforeach
