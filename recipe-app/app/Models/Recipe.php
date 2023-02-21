<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'image',
        'is_active'
    ];

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany('ingredient::class');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo('category::class');
    }
}
