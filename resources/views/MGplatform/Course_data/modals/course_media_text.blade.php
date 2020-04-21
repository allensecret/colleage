@foreach($data as $v)
<div class="modal fade" id="text{{$v->id}}">
    <div class="modal-dialog  modal-lg">
        <form>
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{ $v->data->title }} ep.{{ $v->ep }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="font-size: 1.2rem">
                    <p>下載：
                        <a href="{{ $host->resource_attr.$v->resource->where('type','txt')->first()->attr }}"><i class="fas fa-file-alt" style="font-size: 1.5rem"></i></a>
                        <a href="{{ $host->resource_attr.$v->resource->where('type','big5gb')->first()->attr }}" style="font-size: 1.5rem">簡</a>
                        <a href="{{ $host->resource_attr.$v->resource->where('type','pdf')->first()->attr }}"><i class="far fa-file-pdf" style="font-size: 1.5rem"></i></a>
                        <a href="{{ $host->resource_attr.$v->resource->where('type','doc')->first()->attr }}"><i class="far fa-file-word" style="font-size: 1.5rem"></i></a>
                    </p>
                    {!! $txt->txt('http:'.$host->resource_attr.$v->resource->where('type','txt')->first()->attr) !!}
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endforeach
