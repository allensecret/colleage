<!-- The Modal -->
@foreach($data->curricula->where('level',$id) as $l)
<div class="modal" id="modify{{ $l->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('subject_class.update',['subject_class'=>$l]) }}" id="create_form" method="POST">
                @method('PATCH')
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">修改課程</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" name="level" value="{{ $data->id }}">

                    <div class="form-group">
                        <label for="class">課程：</label>
                        <select class="form-control" id="course_data" name="course_data">
                            @foreach($course as $c)
                                <option value="{{ $c->id }}" {{ $l->course_data == $c->id ? "selected":""}}>{{ $c->sn."-".$c->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class_type">修別：</label>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="compulsory" value="1" {{ $l->compulsory == 1 ? "checked":"" }}>必修
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="compulsory" value="2" {{ $l->compulsory == 2 ? "checked":"" }}>選修
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="class_homework">提交報告：</label>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="report" value="1" {{ $l->report == 1 ? "checked":"" }}><i class="fa fa-check" style="font-size: 1.3rem;color: green"></i>
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="report" value="0" {{ $l->report == 0 ? "checked":"" }}><i class="fas fa-times" style="font-size: 1.3rem;color: red"></i>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="maximum">報告字數:</label>
                        <input type="number" class="form-control" id="maximum" name="report_maximum" value="{{ $l->report_maximum }}">
                    </div>

                    <div class="form-group">
                        <label for="pwd">備註：</label>
                        <textarea class="form-control" rows="3" id="remark" name="remark">{{ $l->remark }}</textarea>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">修改</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endforeach
