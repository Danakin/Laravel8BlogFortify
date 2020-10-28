<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'description', 'height', 'width'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
