@switch($status)
    @case("pending")
        <button class="btn btn-primary btn_make_payment" onclick="makePayment({{$campaign_id}}, {{$customer_id}})">Xác nhận</button>
        @break
        @break
    @default
@endswitch

