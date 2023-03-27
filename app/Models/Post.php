<?php

namespace App\Models;

use Carbon\Carbon;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',

    ];
    public function getCreatedAtAttribute($value)
    {
        return carbon::parse($value)->format('Y-m-d');
    }
    public function User()
    {
        return $this->belongsTo(User::class)->withDefault();

    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected static function booted()
    {
        static::deleted(function ($post) {
            Storage::delete('public/images/' . $post->image);
        });
    }

}
$posts = Post::with('user')->get();
