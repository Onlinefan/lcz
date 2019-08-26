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
}
