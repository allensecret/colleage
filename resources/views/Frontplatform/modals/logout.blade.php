<!-- The Modal -->
<div class="modal" id="logout">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(246, 244, 239)">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form class="modal-body" action="{{ route('ST.logout') }}" method="post">
                @csrf
                <div class="container pt-5 pb-5">
                    <h1 class="text-center mb-5"><img src="/img/new_frontplatform/Logo.png" style="width: 50%;height: 50%"></h1>
                    <h2 class="text-center mb-5">{{ Auth::user()->account }}即將登出佛陀教育網路學院</h2>
                    <div class="form-group pl-5 pr-5">
                        <button type="submit" class="btn btn-block" style="border-radius: 15px;background-color:#cfcbc6;font-size: 1.3em">登出</button>
                    </div>
                </div>
            </form>

            <!-- Modal footer -->
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
