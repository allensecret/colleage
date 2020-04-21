@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=gift_li]').addClass('active');
            $('div[name=gift_config]').addClass('show');



            $("#clickAll").click(function() {
                if($("#clickAll").prop("checked")) {
                    $("input[name='list[]']").each(function() {
                        $(this).prop("checked", true);
                    });
                } else {
                    $("input[name='list[]']").each(function() {
                        $(this).prop("checked", false);
                    });
                }
            });

            $('button[name=export]').click(function () {
                $('form').attr('action','{{ route('export') }}');
            });

        });
    </script>
@endpush
@section('navbar')
    <h3>禮品管理</h3>
@endsection
@section('content')
    <form class="row align-items-stretch" action="{{ route('update_status') }}" method="post">
        @csrf
        <div class="col-12">
            <div class="d-flex">
                <div class="p-2 mr-auto"><h3>禮品申請</h3></div>
                <div class="p-2"><button class="btn btn-primary" type="submit" name="export">匯出</button></div>
                <div class="p-2"><button class="btn btn-info" type="submit" name="send">寄送</button></div>
            </div>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <div class="custom-control custom-checkbox ">
                                <input type="checkbox" class="custom-control-input" id="clickAll" name="clickAll">
                                <label class="custom-control-label" for="clickAll"></label>
                            </div>
                        </th>
                        <th>學號</th>
                        <th>收件人信名</th>
                        <th>電話</th>
                        <th>地址</th>
                        @foreach($item as $i)
                            <th>{{ $i->name }}</th>
                        @endforeach
                        <th>寄送狀態</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="Check{{ $d->id }}" name="list[]" value="{{ $d->id }}">
                                    <label class="custom-control-label" for="Check{{ $d->id }}"></label>
                                </div>
                            </td>
                            <td>{{ $d->student_data->account }}</td>
                            <td>{{ $d->addressee }}</td>
                            <td>{{ $d->phone }}</td>
                            <td>{{ $d->send_address }}</td>
                            @foreach($item as $j)
                                <td>{{ in_array($j->id,explode(";",$d->item)) ? "V":"" }}</td>
                            @endforeach
                            <td>{{ $d->send_status == 0 ? "未寄送":"已寄送" }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $data->links() }}
        </div>
    </form>
@endsection

