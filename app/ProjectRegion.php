<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectRegion - model for project_regions table
 * @package App
 */
class ProjectRegion extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_regions';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public static function createRecords($arRegions, $projectId)
    {
        foreach ($arRegions as $regionId) {
            self::createRecord($regionId, $projectId);
        }
    }

    public static function createRecord($regionId, $projectId)
    {
        $projectRegion = new ProjectRegion(['project_id' => $projectId, 'region_id' => $regionId]);
        $projectRegion->country_id = $projectRegion->region->country_id;
        $projectRegion->save();
    }
}
