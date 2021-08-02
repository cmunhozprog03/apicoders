<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\apiTrait;

class Tag extends Model
{
    use HasFactory, apiTrait;

    protected $guarded = ['id'];

    // Many-> Many
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
