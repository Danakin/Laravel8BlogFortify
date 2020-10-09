<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "slug",
        "description",
        "image",
        "published",
    ];

    // https://laravel.com/docs/8.x/eloquent-mutators#defining-an-accessor
    public function getShortDescriptionAttribute()
    {
        // Access with $post->short_description - Laravel Mutators
        return Str::limit($this->description, 147, '(...)');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}