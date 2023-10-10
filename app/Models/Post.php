<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
