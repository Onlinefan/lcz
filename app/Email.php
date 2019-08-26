<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Email model for emails table
 * @package App
 */
class Email extends Model
{
    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
