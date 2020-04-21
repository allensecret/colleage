@foreach($data as $d)
<!-- The Modal -->
<div class="modal" id="delete{{ $d->id }}">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('gift_item.destroy',['gift_item'=>$d]) }}" method="post">
        @csrf
        @method('DELETE')
        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">刪除</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body text-center">
                <h3>將刪除 {{ $d->name }} ?</h3>
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
