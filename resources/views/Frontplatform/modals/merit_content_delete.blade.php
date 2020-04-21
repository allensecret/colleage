@if($merit->item_data->where('student',\Illuminate\Support\Facades\Auth::user()->id)->count() > 0)
    @foreach($merit->item_data->where('student',\Illuminate\Support\Facades\Auth::user()->id) as $d)
    <!-- The Modal -->
    <div class="modal" id="delete_custom{{ $d->id }}">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: rgb(246, 244, 239)">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <form class="modal-body" action="{{ route('merit.destroy',['merit'=>$d]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="container pt-5 pb-5">
                        <h2 class="text-center mb-5">刪除功課</h2>

                        <div class="form-group pl-5 pr-5 text-center">
                            <h3 style="color: #ef0d0c">確定刪除"{{ $d->item }}"功課?</h3>
                        </div>
                        <div class="form-group pl-5 pr-5 pt-3">
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
@endif
