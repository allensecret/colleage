@foreach($list as $l)
        <!-- The Modal -->
        <div class="modal" id="sumbit_report{{ $l->id }}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $l->account }}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <thead>
                            <tr style="font-size: 1.3rem">
                                <th>編號</th>
                                <th>課程</th>
                                <th>成績</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($l->report as $r)
                                    @if(isset($r->course->level) && $r->course->level == $students_update)
                                    <tr>
                                        <td>{{ $r->course->coursedata->sn }}</td>
                                        <td>{{ $r->course->coursedata->title }}</td>
                                        <td>{{ $r->grade }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
@endforeach

