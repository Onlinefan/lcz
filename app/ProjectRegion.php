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
        foreach ($arRegions['id'] as $key => $regionId) {
            self::createRecord($regionId, $projectId, $arRegions['address_count'][$key]);
        }
    }

    public static function createRecord($regionId, $projectId, $addressCount)
    {
        $projectRegion = new ProjectRegion(['project_id' => $projectId, 'region_id' => $regionId, 'address_count' => $addressCount]);
        $projectRegion->country_id = $projectRegion->region->country_id;
        $projectRegion->save();
    }

    public static function updateRecords($arRegions, $projectId)
    {
        ProjectRegion::where(['project_id' => $projectId])->delete();
        self::createRecords($arRegions, $projectId);
    }

    public function projectStatus()
    {
        return ProjectStatus::where([['project_id', '=', $this->project_id], ['region_id', '=', $this->region_id]])->get();
    }

    public function cafapPo()
    {
        $cafap = Cafap::where(['project_id' => $this->project_id])->first();
        if ($cafap) {
            $cafapRegion = CafapRegion::where([['cafap_id', '=', $cafap->id], ['region_id', '=', $this->region_id]])->first();
            if ($cafapRegion) {
                $cafapPo = CafapRegionPo::find($cafapRegion->cafap_po);
                if ($cafapPo) {
                    return $cafapPo->name;
                } else {
                    return '';
                }
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public function cafapAndromeda()
    {
        $cafap = Cafap::where(['project_id' => $this->project_id])->first();
        if ($cafap) {
            $cafapRegion = CafapAndromedaExist::where([['cafap_id', '=', $cafap->id], ['region_id', '=', $this->region_id]])->first();
            if ($cafapRegion) {
                return $cafapRegion->exist;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}
