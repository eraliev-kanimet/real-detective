<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'service',
        'icon',
        'visible',
    ];

    public $timestamps = false;

    public static array $services = [
        'private_person' => 'Для частных лиц',
        'business' => 'Для Бизнеса'
    ];

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }
}
