<?php

namespace App\Models;

class ProductHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_history';
    protected $guarded = ['id'];


    public function logs()
    {
        return $this->belongsTo(Product::class);
    }

}
