<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectContact model for project_contacts table
 * @package App
 */
class ProjectContact extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_roads';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
