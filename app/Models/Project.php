<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'full_description',
        'cover_image',
        'demo_url',
        'github_url',
        'is_featured',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Get the images for the project.
     */
    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order_index');
    }

    /**
     * Get the technologies for the project.
     */
    public function technologies()
    {
        return $this->hasMany(ProjectTechnology::class);
    }

    /**
     * Get the user who created the project.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Scope a query to only include published projects.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope a query to only include draft projects.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope a query to only include featured projects.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to get published featured projects.
     */
    public function scopePublishedFeatured($query)
    {
        return $query->published()->featured();
    }

    /**
     * Check if the project is published.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Check if the project is a draft.
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }
}
