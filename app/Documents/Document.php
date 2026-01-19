<?php

declare(strict_types=1);

namespace App\Documents;

use App\Documents\Components\Item;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

abstract class Document implements Arrayable
{
    /**
     * @var Collection
     */
    public Collection $items;

    public function __construct(
    ) {
        $this->items = new Collection();
    }

    /**
     * Get the value of items
     *
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * Add item
     *
     * @param  Item $item
     * @return self
     */
    public function addItem(Item $item): self
    {
        $this->items->push($item);

        return $this;
    }

    /**
     * Get the total sum of the document
     *
     * @return float
     */
    public function getTotal(): float
    {
        return $this->items->sum(fn (Item $item) => $item->totalPrice);
    }

    public function saveToDatabase()
    {

    }
}
