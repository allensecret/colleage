@foreach($feature->item as $i)
    <!-- The Modal -->
    <div class="modal" id="delete_{{ $i->id }}">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('features_item_delete',['item'=>$i]) }}" method="post">
            @method('DELETE')
            @csrf
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">刪除細項</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h3>{{ $i->item }}</h3>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">送出</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>

            </form>
        </div>
    </div>
@endforeach
