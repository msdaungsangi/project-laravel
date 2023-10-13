<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Post
 */
class Post extends Model
{
    use  HasFactory;

    const PUBLIC = true;
    const PRIVATE = false;

    protected $fillable = [
        'title',
        'description',
        'public_flag',
        'created_by',
        'updated_by'
    ];
    
    /**
     * users
     *
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    
    /**
     * comments
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
