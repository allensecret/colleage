@foreach($data as $d)
<!-- The Modal -->
<div class="modal" id="reason{{ $d->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{ $d->item == 1 ? "休學":"復學" }}原因</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                {!! $d->reason !!}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">關閉</button>
            </div>

        </div>
    </div>
</div>
@endforeach
