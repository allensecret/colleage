@foreach($list as $l)
    <!-- The Modal -->
    <div class="modal" id="update_exception{{ $l->id }}">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('exception_update',['id'=>$l]) }}" method="POST">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">例外升降級</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="text-align: center">
                    <h3>是否對{{ $l->student_id }}升降級動作</h3>
                    <div class="form-check-inline">
                        <label class="form-check-label" style="font-size: 1.3rem;color: green">
                            <input type="radio" class="form-check-input" name="optradio" value="update"><i class="fas fa-long-arrow-alt-up"></i>升級
                        </label>
                    </div>
                    @if($students_update != 1)
                    <div class="form-check-inline">
                        <label class="form-check-label" style="font-size: 1.3rem;color: red">
                            <input type="radio" class="form-check-input" name="optradio" value="downgrade"><i class="fas fa-long-arrow-alt-down"></i>降級
                        </label>
                    </div>
                    @endif
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
