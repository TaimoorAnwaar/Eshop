<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CheckoutCompletedDatabase extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database',];  
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'order_total' => $this->order->total,
            'customer_name' => $this->order->user->name,
            'message' => 'A new checkout has been completed.',
        ];
    }
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->subject('Order Completed: #' . $this->order->id)
    //         ->line('Dear ' . $this->order->customer->name . ',')
    //         ->line('Your order has been successfully placed.')
    //         ->line('Order ID: ' . $this->order->id)
    //         ->line('Total Amount: $' . number_format($this->order->total, 2))
    //         ->line('Thank you for shopping with us!');
    // }
}

