<?php

namespace App\Providers;

use App\Models\Cart;
use App\Providers\BookCart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CalculatePrice
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $qty;
    public $totalPrice;
    public function __construct($qty,$totalPrice)
    {
        $this->qty =$qty;
        $this->totalPrice =$totalPrice;
    }

    /**
     * Handle the event.
     *
     * @param  BookCart  $event
     * @return void
     */
    public function handle(BookCart $event)
    {

    }
}
