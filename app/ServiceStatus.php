<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceStatus model for service_status table
 * @package App
 */
class ServiceStatus extends Model
{
    /** @var string $table - table name */
    protected $table = 'service_status';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }

    public function scan()
    {
        return $this->belongsTo('App\File', 'scan_payment_document');
    }
}
