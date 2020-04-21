@if(!empty($data))
    @foreach($data->data->level->curricula as $v)
        <!-- The Modal -->
        <div class="modal" id="ck_add{{ $v->id }}">
            <div class="modal-dialog">
                <form class="modal-content" action="{{ route('sup_elective.store') }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">增加課程</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" style="font-size: 1.2rem">
                        確定將"{{ $v->coursedata->sn  }}-{{ $v->coursedata->title }}"課程加入？
                        <input type="hidden" name="id" value="{{ $v->id }}">
                        <input type="hidden" name="student" value="{{ $data->id }}">
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
