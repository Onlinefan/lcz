<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FinancialStatus model for financial_status table
 * @package App
 */
class FinancialStatus extends Model
{
    /** @var string $table - table name */
    protected $table = 'financial_status';

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
