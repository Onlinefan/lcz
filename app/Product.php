<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product model for products table
 * @package App
 */
class Product extends Model
{
    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
