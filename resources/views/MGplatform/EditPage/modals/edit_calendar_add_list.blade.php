@for($i=0;$i<12;$i++)
<!-- The Modal -->
<div class="modal" id="add_list{{ $i }}">
    <form class="modal-dialog modal-lg" action="{{ route('calendar_save',['date' => date("Y-m",strtotime("+".$i." month",strtotime($year."-04")) )]) }}" method="post">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{ date("Y-m",strtotime("+".$i." month",strtotime($year."-04"))) }}辦理事項</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <textarea id="message_edit" name="list">
                    @foreach($data as $v)
                        @if($v->date == date("Y-m",strtotime("+".$i." month",strtotime($year."-04"))))
                            {!! $v->list !!}
                        @endif
                    @endforeach
                </textarea>
            </div>
            {{ csrf_field() }}
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">送出</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
            </div>

        </div>
    </form>
</div>
@endfor
