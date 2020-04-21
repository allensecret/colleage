<!-- The Modal -->
<div class="modal" id="report_delete">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('report.destroy',['curricula'=>$report]) }}" method="post">
            @method('DELETE')
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">刪除文章</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h1 style="text-align: center">確定刪除文章??</h1>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">刪除</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>
        </form>
    </div>
</div>
