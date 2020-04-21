<div class="modal" id="create">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('course_data.store') }}" method="POST">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="col-12 modal-title text-center">新增課程資料<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="course_id">課程編號:</label>
                            <input type="text" class="form-control" id="sn" name="sn">
                            <div>{{ $errors->first('sn') }}</div>
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="course_name">課程名稱:</label>
                            <input type="text" class="form-control" id="title" name="title">
                            <div>{{ $errors->first('title') }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="teacher">授課老師:</label>
                            <input type="text" class="form-control" id="teacher" name="teacher">
                            <div>{{ $errors->first('teacher') }}</div>
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="teacher">分集:</label>
                            <input type="text" class="form-control" id="separation" name="separation">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="ep">集數:</label>
                            <div class="row">
                                <div class="col">
                                    <input type="number" class="form-control" id="start_ep" name="start_ep" value="1" min="1">
                                    <div>{{ $errors->first('start_ep') }}</div>
                                </div>
                                <div class="col-1" style="font-size: 1.5rem">~</div>
                                <div class="col">
                                    <input type="number" class="form-control" id="end_ep" name="end_ep">
                                    <div>{{ $errors->first('end_ep') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="ep">類型:</label>
                            <select class="form-control" id="type" name="type">
                                <option value="mp4">Mp4</option>
                                <option value="mp3">Mp3</option>
                                <option value="avi">Avi</option>
                                <option value="mov">mov</option>
                            </select>
                            <div>{{ $errors->first('type') }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="comment">課程介紹:</label>
                            <textarea name="introduction" class="form-control" rows="5" ></textarea>
                        </div>
                    </div>

                </div>
                @csrf
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">送出</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>
            </form>
        </div>
    </div>
</div>
