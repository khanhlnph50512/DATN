<?php

namespace App\Mail;

use App\Models\Admin\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderSuccessMail extends Mailable
{
    use Queueable, SerializesModels;



    public $order;
    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Success Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.order.success',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
     public function build()
    {
        return $this->subject('Xác nhận đơn hàng từ Website')
                    ->markdown('emails.order.success') // view mail
                    ->with(['order' => $this->order]); // 👈 truyền biến sang view
    }
}
