<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectCountry model for project_countries table
 * @package App
 */
class ProjectCountry extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_countries';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public static function createRecords($arCountries, $projectId)
    {
        foreach ($arCountries as $countryId) {
            self::createRecord($countryId, $projectId);
        }
    }

    public static function createRecord($countryId, $projectId)
    {
        $projectCountry = new ProjectCountry(['project_id' => $projectId, 'country_id' => $countryId]);
        $projectCountry->save();
    }
}
