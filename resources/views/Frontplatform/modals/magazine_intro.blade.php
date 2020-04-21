@foreach($data as $d)
<!-- The Modal -->
<div class="modal" id="myModal{{ $d->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">期別：{{ $d->id }}</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="img-div">
                            <img class="modal-img" src="/storage/magazine_img/{{ $d->image }}" style="width: 100%">
                        </div>
                        <div class="d-flex justify-content-around">
                            <div class="p-2 flex-fill text-center">
                                <a href="/storage/magazine_file/{{ $d->file }}" class="btn btn-primary">觀看</a>
                            </div>
                            <div class="p-2 flex-fill text-center">
                                <a href="{{ route('magazine_download',['magazine'=>$d]) }}" class="btn btn-primary">下載</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        {!! $d->intro !!}
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            </div>

        </div>
    </div>
</div>
@endforeach
