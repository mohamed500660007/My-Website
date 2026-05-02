<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'icon',
        'status',
        'order_index',
    ];

    /**
     * Scope a query to order by index.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index');
    }

    /**
     * Scope a query to get services in display order.
     */
    public function scopeDisplayOrder($query)
    {
        return $query->orderBy('order_index', 'asc');
    }
}
