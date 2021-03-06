<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact model for contacts table
 * @package App
 */
class Contact extends Model
{
    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
