<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Calibration2000 model for calibration_2000 table
 * @package App
 */
class Calibration2000 extends Model
{
    /** @var string $table - table name */
    protected $table = 'calibration_2000';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
