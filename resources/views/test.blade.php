<form action="{{ route('Ppayment', '1') }}" method="POST">
    @csrf
    <input type="hidden" name="total_amount" value="3000">
    <input type="hidden" name="order_item[]" value="1">
    <input type="hidden" name="order_item[]" value="2">
    <input type="hidden" name="quantity[]" value="1">
    <input type="hidden" name="quantity[]" value="2">
    <input type="hidden" name="price[]" value="1000">
    <input type="hidden" name="price[]" value="1000">
    <input type="submit" value="1">
</form>
