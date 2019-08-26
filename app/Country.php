<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country model for table countries
 * @package App
 */
class Country extends Model
{
    /** @var string $table - table name */
    protected $table = 'countries';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
