<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $productsForMail)
    {
        $this->order = $order;
        $this->products = $productsForMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail', ['order' => $this->order, 'products' => $this->products]);
    }
}
