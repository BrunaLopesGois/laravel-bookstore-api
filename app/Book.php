<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;
    public $fillable = ['title', 'cover', 'genre', 'description', 'sale_price'];
}
