<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FootingRequest model for footing_requests table
 * @package App
 */
class FootingRequest extends Model
{
    /** @var string $table - table name */
    protected $table = 'footing_requests';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
