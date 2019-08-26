<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectRegion - model for project_regions table
 * @package App
 */
class ProjectRegion extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_regions';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
