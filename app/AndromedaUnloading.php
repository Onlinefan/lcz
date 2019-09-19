<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AndromedaUnloading model for andromeda_unloading table
 * @package App
 */
class AndromedaUnloading extends Model
{
    /** @var string $table - table name */
    protected $table = 'andromeda_unloading';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
