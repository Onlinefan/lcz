<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cost model for cost table
 * @package App
 */
class Cost extends Model
{
    /** @var string $table - table name */
    protected $table = 'cost';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    public function plan()
    {
        return $this->belongsTo('App\CostPlan');
    }
}
