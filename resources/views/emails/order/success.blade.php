@component('mail::message')
# Cảm ơn bạn đã đặt hàng

**Mã đơn hàng:** {{ $order->code }}

**Tổng tiền:** {{ number_format($order->total_amount) }} VNĐ

**Email nhận hàng:** {{ $order->email }}

@component('mail::button', ['url' => route('client.order.detail', $order->id)])
Xem chi tiết đơn hàng
@endcomponent

@endcomponent
