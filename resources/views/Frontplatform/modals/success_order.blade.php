<!-- The Modal -->
<div class="modal" id="success_order">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(246, 244, 239)">

            <!-- Modal Header -->
            <div class="modal-header">
                <h2>訂閱雜誌</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form class="modal-body order-form" action="{{ route('order') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email" style="font-size: 1.3rem">請輸入您的E-mail：</label>
                    <input type="email" class="form-control" placeholder="Enter email" id="email" name="order_email">
                    <div>
                        @if ($errors->first('order_email'))
                            <span style="color: #ef0d0c">{{ $errors->first('order_email') }}</span>
                        @endif

                        @if($errors->first('repeat_email'))
                            <span style="color: #ef0d0c">{{ $errors->first('repeat_email') }}</span>
                        @endif

                        @if(\Illuminate\Support\Facades\Session::has('success'))
                            <span style="color: #2fa360">{{ \Illuminate\Support\Facades\Session::get('success') }}</span>
                        @endif
                    </div>
                </div>
                <div>
                    <p>說明：目前發現@themail.com、@pchome.com.tw、@sohu.com、@126.com、@263.com、@163.com、@eyou.com、@sina.com與@21cn.com的信箱，會被isp當作廣告信擋掉，以致於無法順利送達，若您是上列信箱，請使用其他Email信箱訂閱，以免收不到雜誌，謝謝！</p>
                    <p>訂閱《佛陀教育雜誌》，啟迪智慧，掌握人生！</p>
                    <p>每半個月，我們將淨空法師最新、最精彩的講演，整理為簡短的篇幅，送至您的信箱。更有淨宗歷代諸祖引導大家念佛，兼有往生實例為其佐證，以固淨業行人之信願。</p>
                    <p>「答疑解惑」則是收集長期以來，淨空法師為同修們解答在修學、生活過程當中所遇到的困難，相信每位修行人都會遇到類似的問題，可在其中找尋答案。</p>
                    <p>很多同修都非常關心法師的行程及每日講經直播訊息，我們將此最新、最準的信息傳遞給諸位。</p>
                    <p >固定欄目：本期專欄<br>
                        　　　　 經論輯要<br>
                        　　　　 印光大師開示<br>
                        　　　　 倫理道德【小故事大智慧】<br>
                        　　　　 因果教育<br>
                        　　　　 答疑解惑<br>
                        　　　　 學佛心得<br>
                    </p>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="p-2">
                        <button type="submit" class="btn btn-danger" id="disorder">取消訂閱</button>
                    </div>
                    <div class="p-2">
                        <button type="submit" class="btn btn-success" id="order">訂閱</button>
                    </div>
                </div>

            </form>

            <!-- Modal footer -->
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
