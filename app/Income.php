<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Income model for income table
 * @package App
 */
class Income extends Model
{
    /** @var string $table - table name */
    protected $table = 'income';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo('App\IncomePlan');
    }
}
