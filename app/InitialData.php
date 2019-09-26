<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InitialData model for initial_data table
 * @package App
 */
class InitialData extends Model
{
    /** @var string $table - table name */
    protected $table = 'initial_data';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function equipmentType()
    {
        return $this->belongsTo('App\Product', 'equipment_type');
    }

    public function roadType()
    {
        return $this->belongsTo('App\RoadType', 'road_type');
    }
}
