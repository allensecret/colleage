<!-- The Modal -->
<div class="modal" id="myModal" data-backdrop="static">
    <div class="modal-dialog">

        <div class="modal-content" style="background-color: rgb(246, 244, 239)">

            <!-- Modal Header -->
            <div class="modal-header">

            </div>

            <!-- Modal body -->
            <div class="modal-body text-center">
                <h1>已變更密碼</h1>
                <a href="{{ route('changePassword.show',['changePassword'=>$data]) }}" class="btn report_btn">重新登入</a>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
