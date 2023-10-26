<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'useURL'];

    public function comments() {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
