<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CafapCollage model for cafap_collage table
 * @package App
 */
class CafapCollage extends Model
{
    /** @var string $table - table name */
    protected $table = 'cafap_collage';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cafap()
    {
        return $this->belongsTo('App\Cafap');
    }
}
