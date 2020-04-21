<!-- The Modal -->
<div class="modal" id="success">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(246, 244, 239)">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="font-size: 1.2rem">
                <p>{{ session('email') }}您好：</p>
                <p>阿彌陀佛！</p>

                您的學號為：{{ session('account') }}<br>
                您的密碼為：amtb*******     [*號表示隱藏-完整密碼請收看Mail]<br>

                <p class="pt-4">請妥善保管您的密碼，因為這是您使用「學生中心」的識別資料，沒有輸入此識別資料，您將無法進入聽課、參與網路心得研討、提交修學報告及修改查詢個人學籍資料。<br>
                若對網路修學有任何不清楚之處，請再至「新生入學」處詳細了解其說明，或寫信給我們 amtb@amtb.org.tw 。<br>
                關於修課須知或升級問題，請至此「學生修學須知」處了解其說明，或是經由 首頁>學生中心>學生修學須知 進入參考。</p>

                　　　　　耑此　敬祝<br>
                道業精進<br>
                法喜充滿<br>
                　　　　　佛陀教育網路學院敬上<br>
                <div class="d-flex justify-content-between">
                    <div class="p-2">此為系統自動發信!請勿回信!</div>
                    <div class="p-2"><a href="/" class="btn submit_btn">前往首頁</a></div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
