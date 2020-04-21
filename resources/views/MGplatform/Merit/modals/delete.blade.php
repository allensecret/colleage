@foreach($data as $d)
<!-- The Modal -->
<div class="modal" id="delete{{ $d->id }}">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('merit_MG.destroy',['Merit_MG'=>$d]) }}" method="post">
        @method('DELETE')
        @csrf
        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">刪除項目</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                將刪除{{ $d->name }}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">送出</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">關閉</button>
            </div>

        </form>
    </div>
</div>
@endforeach
