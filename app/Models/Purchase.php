<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
        'payment_method',
        'status',
        'price',
        'currency'
    ];

    /**
     * Relationship to the Book purchased.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Relationship to the User who purchased it.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
