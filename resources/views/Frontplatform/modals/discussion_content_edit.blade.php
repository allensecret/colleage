@foreach($discussion->replies->where('student',\Illuminate\Support\Facades\Auth::user()->id) as $r)
<!-- The Modal -->
<div class="modal" id="edit{{ $r->id }}">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="{{ route('replies.update',['reply'=>$r->id]) }}" method="post">
            @csrf
            @method('PATCH')
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">修改留言</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <textarea name="content">{{ $r->content }}</textarea>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn report_btn">修改</button>
            </div>

        </form>
    </div>
</div>
@endforeach
