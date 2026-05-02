<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'image_path',
        'order_index',
    ];

    /**
     * Get the project that owns the image.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Scope a query to order by index.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index');
    }
}
