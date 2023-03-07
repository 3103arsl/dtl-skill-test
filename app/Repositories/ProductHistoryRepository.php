<?php

namespace App\Repositories;

use App\Models\ProductHistory;

class ProductHistoryRepository extends BaseRepository
{

    public function __construct()
    {
        $this->model = new ProductHistory();
    }


}
