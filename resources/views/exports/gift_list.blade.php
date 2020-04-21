<table>
    <thead>
    <tr>
        <th>學號</th>
        <th>收件人</th>
        <th>電話</th>
        <th>收件地址</th>
        @foreach($item as $i)
            <th>{{ $i->name }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td>{{ $d->student_data->account }}</td>
            <td>{{ $d->addressee }}</td>
            <td>{{ $d->phone }}</td>
            <td>{{ $d->send_address }}</td>
            @foreach($item as $j)
                <td>{{ in_array($j->id,explode(";",$d->item)) ? "V":"" }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
