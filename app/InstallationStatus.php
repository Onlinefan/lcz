<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InstallationStatus model for installation_status table
 * @package App
 */
class InstallationStatus extends Model
{
    /** @var string $table - table name */
    protected $table = 'installation_status';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
