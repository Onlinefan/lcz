<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectProductCount model for project_products_count
 * @package App
 */
class ProjectProductCount extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_products_count';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public static function createRecords($arProducts, $projectId)
    {
        foreach ($arProducts['product_id'] as $key => $productId) {
            self::createRecord($productId, $arProducts['count'][$key], $projectId);
        }
    }

    public static function createRecord($productId, $count, $projectId)
    {
        $projectProduct = new ProjectProductCount(['project_id' => $projectId, 'product_id' => $productId, 'count' => $count]);
        $projectProduct->save();
    }

    public static function updateRecords($arProducts, $projectId)
    {
        ProjectProductCount::where(['project_id' => $projectId])->delete();
        self::createRecords($arProducts, $projectId);
    }
}
