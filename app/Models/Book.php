<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'currency',
        'cover_image',
        'purchase_url',
        'product_type',
        'digital_file',
        'stock',
        'is_advertisement',
        'status',
    ];

    protected $casts = [
        'is_advertisement' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function isDigital(): bool
    {
        return in_array($this->product_type, ['digital', 'both']);
    }

    public function isPhysical(): bool
    {
        return in_array($this->product_type, ['physical', 'both']);
    }

    public function inStock(): bool
    {
        if ($this->isDigital()) {
            return true;
        }
        return $this->stock === null || $this->stock > 0;
    }
}
