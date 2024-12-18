@component('mail::message')
# Order Confirmation - Thank You for Your Purchase!

Dear {{ $order->user->name }},

Thank you for your order! We have received your order and are processing it. Below are your order details:

## Order Summary
Order Number: **#{{ $order->id }}**  
Order Date: **{{ $order->created_at->format('F j, Y, g:i a') }}**  

### Shipping Information:
**{{ $order->address }}**

## Items in Your Order:
@if ($order->orderItems && $order->orderItems->count() > 0)
    @foreach ($order->orderItems as $item)
    - **{{ $item->product->name }}** (x{{ $item->quantity }}) - ${{ number_format($item->price * $item->quantity, 2) }}
    @endforeach
@else
    <p>No items in your order.</p>
@endif

### Total:
**${{ number_format($order->total_price, 2) }}**

Your items will be shipped soon. You can track your order using the order number above.

If you have any questions or need further assistance, feel free to [contact our support team](mailto:support@yourstore.com).

Thanks again for shopping with us!

@component('mail::button', ['url' => route('home')])
Visit Our Store
@endcomponent

Best regards,  
The Team at Your Store

@endcomponent
