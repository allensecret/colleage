@foreach($teacher as $t)
<!-- The Modal -->
<div class="modal fade" id="detil{{ $t->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header ml-3 mr-3">
                <h1>簡介</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- 其他學生的心得分享 -->
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-6 pb-3">
                        <div class="row" style="margin: 0 auto">
                            <div class="col-12 pb-5">
                                <div class="intro-img" style="background-color: rgb(247, 245, 241);width: 100%;height: 100%;margin: 0px auto">
                                    <img src="{{ asset('storage/img/'.$t->img) }}" style="width: 100%">
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div style="background-color: rgb(247, 245, 241);width: 60px;height: 60px;margin: 0px auto"></div>
                            </div>
                            <div class="col-4 text-center">
                                <div style="background-color: rgb(247, 245, 241);width: 60px;height: 60px;margin: 0px auto"></div>
                            </div>
                            <div class="col-4 text-center">
                                <div style="background-color: rgb(247, 245, 241);width: 60px;height: 60px;margin: 0px auto"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 pb-3">
                        <div style="background-color: rgb(247, 245, 241);width: 300px;height: 400px;margin: 0px auto">
                            {!! $t->introduction !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer" style="border-top:0px">
            </div>

        </div>
    </div>
</div>
@endforeach
