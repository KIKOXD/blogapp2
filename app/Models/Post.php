<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array{!!  !!}
     */
    protected $fillable = [
        'title',
        'description', // Pastikan ini ada di tabel database
        'image',       // Pastikan ini ada di tabel database
        'user_id',     // Jika ada relasi ke pengguna
    ];

    /**
     * Relasi ke model User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($post) {
            // Generate basic slug
            $slug = Str::slug($post->title);
            
            // Check if slug exists
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            
            // If slug exists, append number
            if ($count > 0) {
                $slug = "{$slug}-" . ($count + 1);
            }
            
            $post->slug = $slug;
        });
        
        static::updating(function ($post) {
            // Only update slug if title changed
            if ($post->isDirty('title')) {
                $slug = Str::slug($post->title);
                
                // Check if slug exists and is not the current post
                $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")
                              ->where('id', '!=', $post->id)
                              ->count();
                
                // If slug exists, append number
                if ($count > 0) {
                    $slug = "{$slug}-" . ($count + 1);
                }
                
                $post->slug = $slug;
            }
        });
    }
}
