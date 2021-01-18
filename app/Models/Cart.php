<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id) {
        $storedItem = ['stock' => 0, 'proposed_price' => $item->proposed_price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['stock']++;
        $storedItem['proposed_price'] = $item->proposed_price * $storedItem['stock'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->proposed_price;
    }
    public function reduceByOne($id) {
        $this->items[$id]['stock']--;
        $this->items[$id]['proposed_price'] -= $this->items[$id]['item']['proposed_price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['proposed_price'];

        if ($this->items[$id]['stock'] <= 0) {
            unset($this->items[$id]);
        }
    }
    public function addByOne($id) {
        $this->items[$id]['stock']++;
        $this->items[$id]['proposed_price'] += $this->items[$id]['item']['proposed_price'];
        $this->totalQty++;
        $this->totalPrice += $this->items[$id]['item']['proposed_price'];
    }

    public function removeItem($id) {
        $this->totalQty -= $this->items[$id]['stock'];
        $this->totalPrice -= $this->items[$id]['proposed_price'];
        unset($this->items[$id]);
    }
}
