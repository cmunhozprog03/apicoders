<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\apiTrait;

class Category extends Model
{
    use HasFactory, apiTrait;

    protected $guarded = ['id'];

    protected $allowIncluded = ['posts', 'posts.user'];
    protected $allowFilter = ['id', 'name', 'slug'];
    protected $allowSort = ['id', 'name', 'slug'];

    // One->Many
    public function posts()
    {
        return $this->hasMany(Post::class);
    }





}
