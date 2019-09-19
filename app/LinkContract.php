<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LinkContract model for link_contract table
 * @package App
 */
class LinkContract extends Model
{
    /** @var string $table - table name */
    protected $table = 'link_contract';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
