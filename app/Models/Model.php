<?php

namespace App\Models;

use App\Helpers\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Model extends BaseModel
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected static $logAttributes = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class);
    }

}
