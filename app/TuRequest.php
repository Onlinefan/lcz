<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TuRequest model for tu_requests_table
 * @package App
 */
class TuRequest extends Model
{
    /** @var string $table - table name */
    protected $table = 'tu_requests';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
