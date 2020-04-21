@foreach($data as $d)
    <!-- The Modal -->
    <div class="modal" id="unpass{{ $d->id }}">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('drop.update',['drop'=>$d,'term'=>2]) }}" method="post">
            @csrf
            @method('PATCH')
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">審核</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-center">
                    <h2 style="color: red">將拒絕 {{ $d->student_data->account }} 的申請</h2>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">送出</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>

            </form>
        </div>
    </div>
@endforeach
