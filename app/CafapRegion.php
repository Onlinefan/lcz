<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CafapRegion model for cafap_regions table
 * @package App
 */
class CafapRegion extends Model
{
    /** @var string $table - table name */
    protected $table = 'cafap_regions';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cafap()
    {
        return $this->belongsTo('App\Cafap');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    public static function createRecords($arRegions, $cafapId)
    {
        foreach ($arRegions['region_id'] as $key => $regionId) {
            self::createRecord($regionId, $cafapId, $arRegions['cafap_po'][$key]);
        }
    }

    public static function createRecord($regionId, $cafapId, $cafapPo)
    {
        $cafapRegion = new CafapRegion(['region_id' => $regionId, 'cafap_id' => $cafapId, 'cafap_po' => $cafapPo]);
        $cafapRegion->save();
    }

    public static function updateRecords($arRegions, $cafapId)
    {
        CafapRegion::where(['cafap_id' => $cafapId])->delete();
        self::createRecords($arRegions, $cafapId);
    }
}
