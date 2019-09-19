<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TransferredPnr model for transferred_pnr table
 * @package App
 */
class TransferredPnr extends Model
{
    /** @var string $table - table name */
    protected $table = 'transferred_pnr';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
