@if(!empty($data))
    @foreach($data->curriculas as $v)
        <!-- The Modal -->
        <div class="modal" id="ck_remove{{ $v->id }}">
            <div class="modal-dialog">
                <form class="modal-content" action="{{ route('sup_elective.destroy',['sup_elective'=>$v]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">移除課程</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        確定移除"{{ $v->course->coursedata->sn }}-{{ $v->course->coursedata->title }}"課程？
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
@endif
