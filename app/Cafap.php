<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cafap model for cafap table
 * @package App
 */
class Cafap extends Model
{
    /** @var string $table - table name */
    protected $table = 'cafap';

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
