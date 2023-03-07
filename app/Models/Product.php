<?php

namespace App\Models;


use Spatie\Activitylog\Models\Activity;

class Product extends Model
{
    const TYPE_PRODUCT = 1;
    const TYPE_SERVICE = 2;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_PRODUCT_LABEL = 'Product';
    const TYPE_SERVICE_LABEL = 'Service';
    const STATUS_INACTIVE_LABEL = 'Inactive';
    const STATUS_ACTIVE_LABEL = 'Active';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    protected $guarded = ['id'];
    protected static $logAttributes = ['*'];


    public function logs()
    {
        return $this->hasMany(ProductHistory::class);
    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        return ($this->status == self::STATUS_ACTIVE) ? self::STATUS_ACTIVE_LABEL : self::STATUS_INACTIVE_LABEL;
    }

    /**
     * @return string
     */
    public function getTypeLabel()
    {
        return ($this->type == self::TYPE_PRODUCT) ? self::TYPE_PRODUCT_LABEL : self::TYPE_SERVICE_LABEL;
    }

}
