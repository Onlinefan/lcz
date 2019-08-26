<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contract model for contracts table
 * @package App
 */
class Contract extends Model
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
