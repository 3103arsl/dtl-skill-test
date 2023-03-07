<?php

namespace App\Observers;

use App\Helpers\UserTrait;
use App\Models\Product;
use App\Notifications\NewProductNotification;
use App\Services\ProductLoggerService;

class ProductObserver
{
    use UserTrait;

    private $loggerService;
    private $currentUserID;

    /**
     * @param ProductLoggerService $loggerService
     */
    public function __construct(ProductLoggerService $loggerService)
    {
        $this->currentUserID = $this->getCurrentUserID(true);
        $this->loggerService = $loggerService;
    }

    /**
     * @param Product $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->creator_id = $this->currentUserID;
    }

    /**
     * @param Product $product
     * @return void
     */
    public function created(Product $product): void
    {
        $this->loggerService->setNewProduct($product);
        $this->loggerService->setCreator($this->currentUserID);
        $this->loggerService->log();

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
        $this->loggerService->setOldProduct($product);
        $product->updator_id = $this->currentUserID;
    }

    /**
     * @param Product $product
     * @return void
     */
    public function updated(Product $product): void
    {
        $this->loggerService->setNewProduct($product);
        $this->loggerService->setCreator($this->currentUserID);
        $this->loggerService->log();
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
