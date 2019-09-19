<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AnalysisResult model for analysis_result
 * @package App
 */
class AnalysisResult extends Model
{
    /** @var string $table - table name */
    protected $table = 'analysis_result';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
