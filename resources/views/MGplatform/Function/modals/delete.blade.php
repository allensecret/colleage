@foreach($data as $d)
    <!-- The Modal -->
    <div class="modal" id="delete_{{ $d->id }}">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('features.destroy',['feature'=>$d]) }}" method="post">
                @method('DELETE')
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">刪除項目</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h3>{{ $d->name }}</h3>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">刪除</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
