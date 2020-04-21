<!-- The Modal -->
<div class="modal" id="add_custom">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgb(246, 244, 239)">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form class="modal-body" action="{{ route('merit.update',['merit'=>$merit->id]) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="container pt-5 pb-5">
                    <h2 class="text-center mb-5">新增功課</h2>

                    <div class="form-group pl-5 pr-5">
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group pl-5 pr-5">
                        <button type="submit" class="btn btn-block" style="border-radius: 15px;background-color:#cfcbc6;font-size: 1.3em">新增</button>
                    </div>
                </div>
            </form>

            <!-- Modal footer -->
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
