<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        document.getElementById("paypalForm").submit();
    });
</script>
<form name="paypalForm" id="paypalForm" action="https://secure.paypal.com/cgi-bin/webscr" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="order_id" value="{{$ord_no}}">
    <input type="hidden" name="business" value="friendofafriend12@att.net">
    <input type="hidden" name="amount" value="{{$total_amount}}">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" value="2" name="rm">
    <input type="hidden" name="return" value="{{route('order_success')}}">
    <input type="hidden" name="cancel_return" value="{{route('order_cancel')}}">
    <input type="hidden" name="address_override" value="0">
    <input type="hidden" name="item_number" value="">
    <input type="hidden" name="quantity" value="1">
    <input type="hidden" name="invoice" value="{{$ord_no.'|'.rand(9,999)}}">
    <input type="hidden" name="cbt" value="Please click here to confirm your payment">
    <input type="hidden" name="country" value="GB">
</form>
