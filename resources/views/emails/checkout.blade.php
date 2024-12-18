{{-- 


# Order Confirmation - Thank You for Your Purchase!

Dear {{ $order->user->name }},

Thank you for your order! We have received your order and are processing it. Below are your order details:

## Order Summary
Order Number: **#{{ $order->id }}**  
Order Date: **{{ $order->created_at->format('F j, Y, g:i a') }}**  
<br>

### Shipping Information:
**{{ $order->address }}**

<br>


### Total:
**${{ number_format($order->total_price, 2) }}**
<br>

Your items will be shipped soon. You can track your order using the order number above.

If you have any questions or need further assistance, feel free to [contact our support team](mailto:support@yourstore.com).

Thanks again for shopping with us!
<br>
<br>
<br>

Best regards,  
The Team at Your Store

 --}}
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Order Confirmation</title>
     <style>
         body {
             font-family: Arial, sans-serif;
             line-height: 1.6;
             color: #333;
             margin: 0;
             padding: 0;
             background-color: #f9f9f9;
         }
         .email-container {
             max-width: 600px;
             margin: 20px auto;
             background: #ffffff;
             padding: 20px;
             border-radius: 8px;
             box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
         }
         .email-header {
             text-align: center;
             border-bottom: 2px solid #4CAF50;
             padding-bottom: 10px;
             margin-bottom: 20px;
         }
         .email-header h1 {
             color: #4CAF50;
             font-size: 24px;
             margin: 0;
         }
         .email-content h2 {
             color: #4CAF50;
             font-size: 18px;
             margin-bottom: 10px;
         }
         .email-content p {
             margin: 10px 0;
         }
         .email-content strong {
             color: #333;
         }
         .order-details {
             background: #f3f3f3;
             padding: 15px;
             border-radius: 5px;
             margin-bottom: 20px;
         }
         .email-footer {
             text-align: center;
             margin-top: 20px;
             font-size: 14px;
             color: #666;
         }
         a {
             color: #4CAF50;
             text-decoration: none;
         }
     </style>
 </head>
 <body>
     <div class="email-container">
         <div class="email-header">
             <h1>Order Confirmation</h1>
             <p>Thank you for your purchase!</p>
         </div>
         <div class="email-content">
             <p>Dear <strong>{{ $order->user->name }}</strong>,</p>
             <p>We have received your order and are currently processing it. Below are the details of your order:</p>
             
             <h2>Order Summary</h2>
             <div class="order-details">
                 <p><strong>Order Number:</strong> #{{ $order->id }}</p>
                 <p><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y, g:i a') }}</p>
                 <p><strong>Shipping Address:</Address>:</strong><br>{{ $order->address }}</p>
                 <p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
             </div>
             <p>Your items will be shipped soon. You can track your order using the order number provided above.</p>
             <p>If you have any questions or need further assistance, feel free to <a href="mailto:support@yourstore.com">contact our support team</a>.</p>
             <p>Thanks again for shopping with us!</p>
         </div>
         <div class="email-footer">
             <p>Best regards,<br>The Team at Your Store</p>
         </div>
     </div>
 </body>
 </html>
 