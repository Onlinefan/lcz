<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BelongingRoad model for belonging_road table
 * @package App
 */
class BelongingRoad extends Model
{
    /** @var string $table - table name */
    protected $table = 'belonging_road';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
