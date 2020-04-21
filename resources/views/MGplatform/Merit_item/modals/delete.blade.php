@foreach($data->item_data as $i)
    <!-- The Modal -->
    <div class="modal" id="delete{{ $i->id }}">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('merit_item_MG.destroy',['merit_item_MG'=>$i]) }}" method="post">
            @method('DELETE')
            @csrf
            <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">刪除</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-center">
                    <h2>將刪除{{ $i->item }}</h2>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">刪除</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>

            </form>
        </div>
    </div>
@endforeach
