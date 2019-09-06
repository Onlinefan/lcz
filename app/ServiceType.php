<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceType model for service_types table
 * @package App
 */
class ServiceType extends Model
{
    /** @var string $table - table name */
    protected $table = 'service_types';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
