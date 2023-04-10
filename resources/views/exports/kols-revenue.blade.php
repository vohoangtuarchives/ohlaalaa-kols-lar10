<table>
    <thead>
    <tr>
        <th>Stt</th>
        <th>Customer Id</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Điện thoại</th>
        <th>Tên ngân hàng</th>
        <th>Tên chủ tài khoản</th>
        <th>Số tài khoản</th>
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
            <td>{{ $transaction->customer->banking_name }}</td>
            <td>{{ $transaction->customer->banking_account_name }}</td>
            <td>{{ $transaction->customer->banking_account_number }}</td>
            <td>{{ $transaction->sum }}</td>
        </tr>
    @endforeach
    </tbody>
</table>