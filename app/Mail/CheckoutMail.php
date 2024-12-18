<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;

class CheckoutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation - #' . $this->order->id,
        );
    }

    /**
     * Get the message content definition.
     */
    // public function build()
    // {
    //     // Ensure the user exists before trying to access their email
    //     $email = $this->order->user ? $this->order->user->email : null;

    //     // Only send email if user has a valid email address
    //     if ($email) {
    //         return $this->view('emails.checkout')
    //                     ->with(['order' => $this->order]);  // pass the order to the view
    //     }

    //     // Fallback if the user doesn't have an email (ideally this shouldn't happen)
     
    // }

    public function content(): Content
    {
        return new Content(
            view: 'emails.checkout', 
        );
    }
}


