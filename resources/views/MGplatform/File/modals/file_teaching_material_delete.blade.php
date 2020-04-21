@foreach($resources as $r)
    <!-- The Modal -->
    <div class="modal" id="delete_resource{{ $r->id }}">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('teaching_material.destroy',['teaching_material'=>$r])}}" method="post">
                @method('DELETE')
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">刪除資源</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="font-size: 1.3rem">
                    確定刪除"{{ $r->name }}"?
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
