<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pir model for pir table
 * @package App
 */
class Pir extends Model
{
    /** @var string $table - table name */
    protected $table = 'pir';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function surveyStatus()
    {
        return $this->belongsTo('App\SurveyStatus', 'survey_status');
    }

    public function designDocumentation()
    {
        return $this->belongsTo('App\ProjectDocument', 'design_documentation');
    }

    public function requestTu()
    {
        return $this->belongsTo('App\TuRequest', 'request_tu');
    }

    public function requestFooting()
    {
        return $this->belongsTo('App\FootingRequest', 'request_footing');
    }
}
