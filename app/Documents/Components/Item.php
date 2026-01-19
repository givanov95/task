<?php

declare(strict_types=1);

namespace App\Documents\Components;

use App\Models\DocumentItem;

final class Item extends Component
{
    /**
     * @var float
     */
    public readonly float $totalPrice;

    public function __construct(
        public readonly int $id,
        public readonly float $price,
        public readonly float $quantity,
    ) {
        $this->totalPrice = $price * $quantity;
    }

    public function createFromModel(DocumentItem $item)
    {
        $this->id = $item->id;
        $this->price = $item->price;
        $this->quantity = $item->quantity;
    }
}
