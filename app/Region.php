<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Region model for table regions
 * @package App
 */
class Region extends Model
{
    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }
}
