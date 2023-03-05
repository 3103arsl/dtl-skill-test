<?php

namespace App\Observers;

use App\Helpers\UserTrait;
use App\Models\Product;
use App\Notifications\NewProductNotification;

class ProductObserver
{
    use UserTrait;

    /**
     * @param Product $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->creator_id = $this->getCurrentUserID();
    }

    /**
     * @param Product $product
     * @return void
     */
    public function created(Product $product): void
    {
        if ($product && $creator = $product->creator) {
            $creator->notify(new NewProductNotification($product));
        }

    }

    /**
     * @param Product $product
     * @return void
     */
    public function updating(Product $product)
    {
        $product->updator_id = $this->getCurrentUserID();
    }

    /**
     * @param Product $product
     * @return void
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * @param Product $product
     * @return void
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * @param Product $product
     * @return void
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * @param Product $product
     * @return void
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
