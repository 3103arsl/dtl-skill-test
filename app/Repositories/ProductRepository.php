<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{

    public function __construct()
    {
        $this->model = new Product();
    }

    public function getProductsWithSearch($params, $perPage = self::NUMBER_OF_RECORDS)
    {
        $this->setParams($params);
        $search = $this->getKeyword();

        return $this->model
            ->with(['creator' => function ($query) use ($search) {
                if ($this->hasKeyword()) {
                    $query->where('name', '=', $search);
                }
            }])
            ->where(function ($query) use ($search) {
                if ($this->hasKeyword()) {
                    $query->where('name', 'like', $search);
                }
            })
            ->orderBy($this->getSortBy(), $this->getSortOrder())
            ->paginate($this->getPerPage());

    }


    public function getProductByID($id)
    {
        return $this->model->find($id);
    }


}
