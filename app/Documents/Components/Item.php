<?php

declare(strict_types=1);

namespace App\Documents\Components;

final class Item extends Component
{
    /**
     * @var float
     */
    public readonly float $totalPrice;

    public function __construct(
        public readonly float $unitPrice,
        public readonly float $quantity,
    ) {
        $this->totalPrice = $unitPrice * $quantity;
    }

}
