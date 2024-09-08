<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Creation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'sold', 'description', 'dimensions', 'gallerymsg', 'price', 'category_id'];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
