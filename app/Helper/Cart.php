<?php

namespace App\Helper;

use App\Model\Web\ShopItem;
use Illuminate\Support\Collection;

class Cart
{
    /** @var Collection */
    public $items = null;

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        $this->items = collect(session('cart.items', []));
    }

    /**
     * Add new item in cart or increment quantity if he's already exists.
     *
     * @param ShopItem $item
     */
    public function addItem(ShopItem $item)
    {
        if ($this->items->has($item->id)) {
            $this->items->get($item->id)->quantity += $item->quantity;
        } else {
            $this->items->put($item->id, $item);
        }

        $this->save();
    }

    /**
     * Update quantity for given item.
     *
     * @param ShopItem $item
     * @param string $direction
     */
    public function updateQuantity(ShopItem $item, string $direction)
    {
        if ($this->items->has($item->id)) {
            if ($direction === 'up') {
                $this->items->get($item->id)->quantity++;
            } else {
                $this->items->get($item->id)->quantity--;
            }

            if ($this->items->get($item->id)->quantity <= 0) {
                $this->removeItem($item);
            }
        }

        $this->save();
    }

    /**
     * Remove an given item.
     *
     * @param ShopItem $item
     */
    public function removeItem(ShopItem $item)
    {
        if ($this->items->has($item->id)) {
            $this->items->offsetUnset($item->id);
        }

        $this->save();
    }

    /**
     * Clear current cart.
     */
    public function clear()
    {
        $this->items = new Collection();

        $this->save();
    }

    /**
     * Return true if cart is empty, false else if he's not empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->items->isEmpty();
    }

    /**
     * Return true if cart is not empty, false else if he's empty.
     *
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return $this->items->isNotEmpty();
    }

    /**
     * Return total unit price for cs type.
     *
     * @return int
     */
    public function getTotalUnitCsPrice(): int
    {
        $total = 0;

        $this->items->each(function (ShopItem $item) use (&$total) {
            if ($item->sale_type == ShopItem::SALE_CS_TYPE) {
                $total += $item->price;
            }
        });

        return $total;
    }

    /**
     * Return total ttl price for cs type.
     *
     * @return int
     */
    public function getTotalTtlCsPrice(): int
    {
        $total = 0;

        $this->items->each(function (ShopItem $item) use (&$total) {
            if ($item->sale_type == ShopItem::SALE_CS_TYPE) {
                $total += $item->total_price;
            }
        });

        return $total;
    }

    /**
     * Return total unit price for vote type.
     *
     * @return int
     */
    public function getTotalUnitVotePrice(): int
    {
        $total = 0;

        $this->items->each(function (ShopItem $item) use (&$total) {
            if ($item->sale_type == ShopItem::SALE_VOTE_TYPE) {
                $total += $item->price;
            }
        });

        return $total;
    }

    /**
     * Return total ttl price for vote type.
     *
     * @return int
     */
    public function getTotalTtlVotePrice(): int
    {
        $total = 0;

        $this->items->each(function (ShopItem $item) use (&$total) {
            if ($item->sale_type == ShopItem::SALE_VOTE_TYPE) {
                $total += $item->total_price;
            }
        });

        return $total;
    }

    /**
     * Save current cart in session.
     */
    private function save()
    {
        session(['cart.items' => $this->items->all()]);
    }
}