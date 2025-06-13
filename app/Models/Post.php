<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// app/Models/Post.php
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'slug', 'image'];
}

