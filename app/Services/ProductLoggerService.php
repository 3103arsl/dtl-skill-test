<?php

namespace App\Services;

use App\Repositories\ProductHistoryRepository;

class ProductLoggerService
{
    private $creator;
    private $oldProduct;
    private $newProduct;
    private $productHistoryRepository;

    public function __construct(ProductHistoryRepository $productHistoryRepository)
    {
        $this->productHistoryRepository = $productHistoryRepository;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @return mixed
     */
    public function getOldProduct()
    {
        return $this->oldProduct;
    }

    /**
     * @param mixed $oldProduct
     */
    public function setOldProduct($oldProduct): void
    {
        $this->oldProduct = $oldProduct;
    }

    /**
     * @return mixed
     */
    public function getNewProduct()
    {
        return $this->newProduct;
    }

    /**
     * @param mixed $newProduct
     */
    public function setNewProduct($newProduct): void
    {
        $this->newProduct = $newProduct;
    }

    public function log()
    {
        $this->productHistoryRepository->save([
            'creator_id' => $this->creator,
            'product_id' => $this->newProduct->id,
            'old_properties' => ($this->oldProduct) ? $this->oldProduct->toJson() : null,
            'new_properties' => $this->newProduct->toJson(),
        ]);
    }
}
