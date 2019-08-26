<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectResponsibilityArea model for project_responsibility_area table
 * @package App
 */
class ProjectResponsibilityArea extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_responsibility_area';

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
