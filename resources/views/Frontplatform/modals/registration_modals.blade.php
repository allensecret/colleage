<!-- The Modal -->
<div class="modal fade" id="myModal" data-backdrop="static" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: rgb(247, 245, 241);">
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="background-color: rgb(247, 245, 241);">
                <h3>{{ old('name') }}您好，阿彌陀佛!</h3>
                <p class="text-center" style="font-size: 1.3rem;padding-top:30px ;">您的學號為：{{ session('student_id') }}</p>
                <p style="font-size: 1.2rem;padding-top:30px;padding-bottom:100px ;">若您考量後，確實能依照網路學院規定的做到，再填報名表，我們收到資料後會發一封信給正式學員，並告知一個識別的學號及密碼。此學生及密碼，將使用在「學生中心」中，請務必妥善保管您的密碼。這是您使用「學生中心」的識別資料，沒有輸入此識別資料，您將無法進入聽課、參與網路心得研討、提交修學報告及修改查詢個人學籍資料。</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer" style="border-top:0px;display:inline;">
                <div class="row">
                    <div class="col-12 col-lg-6" style="display: flex;align-self: flex-end;padding-bottom: 12px;">
                        <a href="/" class="btn go_classromm">前往上課</a>
                    </div>
                    <div class="col-12 col-lg-6  text-right" style="font-size: 1.1rem;">
                        <p>耑此 敬祝</p>
                        <p>道業精進 法喜充滿</p>
                        <p>佛陀教育網路學院敬上</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
