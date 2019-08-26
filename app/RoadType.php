<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RoadType model for road_types table
 * @package App
 */
class RoadType extends Model
{
    /** @var string $table - table name */
    protected $table = 'road_types';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
