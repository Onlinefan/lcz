<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CountryCode model for country_codes table
 * @package App
 */
class CountryCode extends Model
{
    /** @var string $table - table name */
    protected $table = 'country_codes';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
