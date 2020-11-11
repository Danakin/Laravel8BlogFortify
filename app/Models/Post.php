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

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($post) {
    //         $post->slug = Str::slug(
    //             date("Ymd") . "-" . Str::limit($post->title, 55),
    //             "-"
    //         );
    //     });
    // }

    // https://laravel.com/docs/8.x/eloquent-mutators#defining-an-accessor
    public function getShortDescriptionAttribute()
    {
        // Access with $post->short_description - Laravel Mutators
        return Str::limit(strip_tags($this->description), 147, '(...)');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
