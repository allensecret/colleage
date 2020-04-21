@foreach($data->curricula->where('level',$id) as $l)
    <!-- The Modal -->
    <div class="modal" id="delete{{ $l->id }}">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('subject_class.destroy',['subject_class'=>$l]) }}" method="POST">
                @method('DELETE')
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">刪除</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="color: red;font-size: 1.3rem">
                    確定刪除“{{ $l->coursedata->sn }}__{{ $l->coursedata->title }}“課程？
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
