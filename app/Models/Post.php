<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\apiTrait;

class Post extends Model
{
    use HasFactory, apiTrait;

    const BORRADOR = 1;
    const PUBLICADO = 2;


    protected $fillable = ['name', 'slug', 'extract', 'body', 'status','category_id', 'user_id'];

    protected $allowFilter = ['id', 'name', 'slug'];
    protected $allowSort = ['id', 'name', 'slug'];
    // Reverce One-<many
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Many->many
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //MorphMany
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
