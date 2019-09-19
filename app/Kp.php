<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Kp model for kp table
 * @package App
 */
class Kp extends Model
{
    /** @var string $table - table name */
    protected $table = 'kp';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
