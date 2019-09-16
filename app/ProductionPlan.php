<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;

/**
 * Class ProductionPlan model for production_plan table
 * @package App
 */
class ProductionPlan extends Model
{
    /** @var string $table - table name */
    protected $table = 'production_plan';

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public static function createRecords($arProductionPlan, $arProductionFiles, $project)
    {
        foreach ($arProductionPlan['month'] as $key => $month) {
            $fileStart = new File();
            $fileStartName = File::createName($project->name);
            $fileStart->createFile($arProductionFiles['preliminary_calculation_equipment'][$key], public_path('/Проекты/' . $project->code . '/Управление проектом/Предварительный расчет оборудования/'), $fileStartName);

            $fileEnd = new File();
            $fileEndName = File::createName($project->name);
            $fileEnd->createFile($arProductionFiles['final_equipment_calculation'][$key], public_path('/Проекты/' . $project->code . '/Управление проектом/Окончательный расчет оборудования/'), $fileEndName);

            $productionPlan = new ProductionPlan([
                'month' => $month,
                'region_id' => $arProductionPlan['region_id'][$key],
                'product_id' => $arProductionPlan['product_id'][$key],
                'project_id' => $project->id,
                'rk_count' => $arProductionPlan['rk_count'][$key],
                'date_shipping' => $arProductionPlan['date_shipping'][$key],
                'priority' => $arProductionPlan['priority'][$key],
                'preliminary_calculation_equipment' => $fileStart->id,
                'final_calculation_equipment' => $fileEnd->id
            ]);
            $productionPlan->save();
        }
    }

    public static function updateRecords($arProductionPlan, $arProductionFiles, $project)
    {
        $oldProductionPlan = ProductionPlan::where(['project_id' => $project->id])->get();
        $fileSystem = new Filesystem();
        foreach ($oldProductionPlan as $plan) {
            $fileSystem->delete(public_path('Проекты/' . $project->code . '/Управление проектом/Предварительный расчет оборудования/' . $plan->preliminaryCalculation->file_name));
            $fileSystem->delete(public_path('Проекты/' . $project->code . '/Управление проектом/Окончательный расчет оборудования/' . $plan->finalCalculation->file_name));
            $plan->preliminaryCalculation()->delete();
            $plan->finalCalculation()->delete();
            $plan->delete();
        }
        self::createRecords($arProductionPlan, $arProductionFiles, $project);
    }

    public function preliminaryCalculation()
    {
        return $this->belongsTo('App\File', 'preliminary_calculation_equipment');
    }

    public function finalCalculation()
    {
        return $this->belongsTo('App\File', 'final_calculation_equipment');
    }
}
