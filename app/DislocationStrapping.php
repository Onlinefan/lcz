<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DislocationStrapping model for dislocation_strapping table
 * @package App
 */
class DislocationStrapping extends Model
{
    /** @var string $table - table name */
    protected $table = 'dislocation_strapping';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
