<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ComplexToMonitoring model for complex_to_monitoring table
 * @package App
 */
class ComplexToMonitoring extends Model
{
    /** @var string $table - table name */
    protected $table = 'complex_to_monitoring';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
