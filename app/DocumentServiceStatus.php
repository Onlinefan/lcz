<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DocumentServiceStatus model for documents_service_status
 * @package App
 */
class DocumentServiceStatus extends Model
{
    /** @var string $table - table name */
    protected $table = 'documents_service_status';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }
}
