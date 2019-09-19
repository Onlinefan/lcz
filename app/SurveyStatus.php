<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SurveyStatus model for survey_statuses table
 * @package App
 */
class SurveyStatus extends Model
{
    /** @var string $table - table name */
    protected $table = 'survey_statuses';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
