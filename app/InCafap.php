<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InCafap model for in_cafap table
 * @package App
 */
class InCafap extends Model
{
    /** @var string $table - table name */
    protected $table = 'in_cafap';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
