<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Document model for documents table
 * @package App
 */
class Document extends Model
{
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
