<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectRoad model for project_roads table
 * @package App
 */
class ProjectRoad extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_roads';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function road()
    {
        return $this->belongsTo('App\RoadType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public static function createRecords($arRoads, $projectId)
    {
        foreach ($arRoads['road_id'] as $key => $roadId) {
            self::createRecord($roadId, $arRoads['count'][$key], $projectId);
        }
    }

    public static function createRecord($roadId, $count, $projectId)
    {
        $projectRoad = new ProjectRoad(['project_id' => $projectId, 'road_id' => $roadId, 'count' => $count]);
        $projectRoad->save();
    }
}
