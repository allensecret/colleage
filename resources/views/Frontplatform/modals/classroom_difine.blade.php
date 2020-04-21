@foreach(Auth::user()->curriculas as $c)
    <!-- The Modal -->
<div class="modal fade" id="custom{{ $c->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="border-bottom:0px">
                <h2 class="modal-title font-DFXing">自訂已完成集數</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body text-center ml-3 mr-3">
                <form action="{{ route('classroom.update',['classroom'=>$c]) }}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        @foreach($c->course->coursedata->get_media as $m)
                            <div class="col-2 pb-4">
                                <label class="form-check-label" style="font-size: 1.2rem;">
                                    <input type="checkbox" class="form-check-input" name="custom_done_ep[]" value="{{ $m->course_data.'_'.$m->ep }}" {{ in_array($m->course_data.'_'.$m->ep,mb_split(';',$c->done_ep)) ? "checked":"" }}>  第{{ $m->ep }}集
                                </label>
                            </div>
                        @endforeach
                        <div class="col-12 pt-4">
                            <button type="submit" class="btn report_btn">送出</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer" style="border-top:0px">
            </div>
        </div>
    </div>
</div>
@endforeach
