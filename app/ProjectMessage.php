<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectMessage model for project_messages table
 * @package App
 */
class ProjectMessage extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_messages';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
