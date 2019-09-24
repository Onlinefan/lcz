<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CafapRegionPo model for cafap_region_po table
 * @package App
 */
class CafapRegionPo extends Model
{
    /** @var string $table - table name */
    protected $table = 'cafap_region_po';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
