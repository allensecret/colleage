<!-- The Modal -->
<div class="modal" id="announcement">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(246, 244, 239)">

            <!-- Modal Header -->
            <div class="modal-header">
                <h2>重要通知</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" >
                {!! $announcement_page->content ?? "" !!}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
