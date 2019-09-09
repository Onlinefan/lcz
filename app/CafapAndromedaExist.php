<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CafapAndromedaExist model for cafap_andromeda_exists
 * @package App
 */
class CafapAndromedaExist extends Model
{
    /** @var string $table - table name */
    protected $table = 'cafap_andromeda_exists';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    public static function createRecords($arAndromeda, $cafapId)
    {
        foreach ($arAndromeda['region_id'] as $key => $regionId) {
            self::createRecord($regionId, $cafapId, $arAndromeda['exist'][$key]);
        }
    }

    public static function createRecord($regionId, $cafapId, $exist)
    {
        $cafapAndromeda = new CafapAndromedaExist(['region_id' => $regionId, 'cafap_id' => $cafapId, 'exist' => $exist]);
        $cafapAndromeda->save();
    }
}
