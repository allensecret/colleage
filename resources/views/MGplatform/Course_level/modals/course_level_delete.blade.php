@foreach($data as $v)
    @foreach($v->course_level as $name)
        <div class="modal" id="delete{{ $name->id }}">
            <div class="modal-dialog">
                <form class="modal-content" action="{{ route('course_level.destroy',['course_level'=>$name]) }}" method="POST">
                    @csrf
                        @method('delete')
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">刪除</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" style="font-size: 1.3rem">
                        {{ $name->level }}
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
@endforeach
