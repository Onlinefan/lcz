<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ShipmentStatus model for shipment_statuses_table
 * @package App
 */
class ShipmentStatus extends Model
{
    /** @var string $table - table name */
    protected $table = 'shipment_statuses';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
