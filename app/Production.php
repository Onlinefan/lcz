<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Production model for production table
 * @package App
 */
class Production extends Model
{
    /** @var string $table - table name */
    protected $table = 'production';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function shipmentStatus()
    {
        return $this->belongsTo('App\ShipmentStatus', 'shipment_status');
    }
}
