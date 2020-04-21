@foreach($has_curricula as $c)
<!-- The Modal -->
<div class="modal" id="delete{{ $c->id }}">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgb(246, 244, 239)">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form class="modal-body" action="{{ route('elective_course.destroy',['elective_course'=>$c->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="container pt-5 pb-5">
                    <h2 class="text-center mb-5">確定刪除"{{ $c->coursedata->title }}"課程？</h2>
                    <div class="form-group pl-5 pr-5">
                        <button type="submit" class="btn btn-block" style="border-radius: 15px;background-color:#cfcbc6;font-size: 1.3em">刪除</button>
                    </div>
                </div>
            </form>

            <!-- Modal footer -->
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
@endforeach
