<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\apiTrait;

class Image extends Model
{
    use HasFactory, apiTrait;
    protected $guraded = ['id'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
