<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $statusText;
    public $statusColor;
    public $customMessage;

    public function __construct(Order $order, $statusText, $statusColor, $customMessage = null)
    {
        $this->order = $order;
        $this->statusText = $statusText;
        $this->statusColor = $statusColor;
        $this->customMessage = $customMessage;
    }

    public function build()
    {
        return $this->subject('Order Status Update - ' . $this->order->order_number . ' - ' . config('app.name'))
            ->view('emails.order-status-update')
            ->with([
                'order' => $this->order,
                'statusText' => $this->statusText,
                'statusColor' => $this->statusColor,
                'customMessage' => $this->customMessage,
            ]);
    }
}
