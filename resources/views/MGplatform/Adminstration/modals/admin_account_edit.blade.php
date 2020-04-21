@foreach($data as $v)
<div class="modal" id="edit_{{ $v->id }}">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('account.update',['account'=>$v]) }}" method="post">
            @method('PATCH')
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">修改</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="account">名稱：</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $v->name }}">
                    </div>
                    <div class="form-group">
                        <label for="account">帳號：</label>
                        <input type="text" class="form-control" id="account" name="account" value="{{ $v->account }}">
                    </div>
                    <div class="form-group">
                        <label for="pwd">密碼：</label>
                        <input type="password" class="form-control" id="password" name="password" value="">
                    </div>
                    <div class="form-group">
                        <label for="role">角色：</label>
                        <select class="form-control" id="role" name="role">
                            @foreach($role as $r)
                                <option value="{{ $r->id }}" {{ $r->id == $v->role ? "selected":""}}>{{ $r->class }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">送出</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                </div>

        </form>
    </div>
</div>
@endforeach
