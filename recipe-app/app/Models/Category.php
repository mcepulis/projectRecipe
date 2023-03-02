<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'is_active'
    ];

    protected $attributes = [
        'is_active' => false
    ];

    public function recipes(): HasMany {
        return $this->hasMany(Recipe::class);
    }

    // public function ingredients(): hasMany {

    // return $this->hasMany(ingredient::class);
    // }
}


