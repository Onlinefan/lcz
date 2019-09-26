<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pnr model for pnr table
 * @package App
 */
class Pnr extends Model
{
    /** @var string $table - table name */
    protected $table = 'pnr';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function calibration2000()
    {
        return $this->belongsTo('App\Calibration2000', 'calibration_2000');
    }

    public function kpLink()
    {
        return $this->belongsTo('App\Kp', 'kp');
    }

    public function analysisResult()
    {
        return $this->belongsTo('App\AnalysisResult', 'analysis_result');
    }

    public function complexToMonitoring()
    {
        return $this->belongsTo('App\ComplexToMonitoring', 'complex_to_monitoring');
    }

    public function andromedaUnloading()
    {
        return $this->belongsTo('App\AndromedaUnloading', 'andromeda_unloading');
    }

    public function inCafap()
    {
        return $this->belongsTo('App\InCafap', 'in_cafap');
    }
}
