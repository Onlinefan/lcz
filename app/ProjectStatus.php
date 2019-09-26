<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectStatus model for project_status table
 * @package App
 */
class ProjectStatus extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_status';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function initialData()
    {
        return $this->hasOne('App\InitialData', 'complex_id');
    }

    public function pir()
    {
        return $this->hasOne('App\Pir', 'complex_id');
    }

    public function production()
    {
        return $this->hasOne('App\Production', 'complex_id');
    }

    public function smr()
    {
        return $this->hasOne('App\SmrInstallation', 'complex_id');
    }

    public function pnr()
    {
        return $this->hasOne('App\Pnr', 'complex_id');
    }

    public function document()
    {
        return $this->hasOne('App\Document', 'complex_id');
    }

    public function affiliationRoad()
    {
        return $this->belongsTo('App\BelongingRoad', 'affiliation_of_the_road');
    }
}
