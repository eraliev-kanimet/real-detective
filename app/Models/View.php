<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class View extends Model
{
    protected $fillable = [
        'value'
    ];

    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }
}
