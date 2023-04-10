<table>
    <thead>
    <tr>
        <th>Stt</th>
        <th>Customer Id</th>
        <th>Tên</th>
        <th>EMail</th>
        <th>Điện thoại</th>
        <th>Tổng tiền</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $stt => $transaction)
        <tr>
            <td>{{$stt+1}}</td>
            <td>{{ $transaction->customer_id }}</td>
            <td>{{ $transaction->customer->name }}</td>
            <td>{{ $transaction->customer->email }}</td>
            <td>{{ $transaction->customer->phone }}</td>
            <td>{{ $transaction->sum }}</td>
        </tr>
    @endforeach
    </tbody>
</table>