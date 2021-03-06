<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

/**
 * Class Contract model for contracts table
 * @package App
 */
class Contract extends Model
{
    const notNeed = 'Не требуется';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    protected $attributes = [
        'equipment_produce' => self::notNeed,
        'equipment_supply' => self::notNeed,
        'smr_start' => self::notNeed,
        'smr_end' => self::notNeed,
        'installation_start' => self::notNeed,
        'installation_end' => self::notNeed,
        'pnr_start' => self::notNeed,
        'pnr_end' => self::notNeed,
    ];

    /** @var array $contractFiles -  Correlates table columns and file location paths*/
    private static $contractFiles = [
        'decree_scan' => 'Приказ/',
        'project_charter' => 'Устав проекта/',
        'plan_chart' => 'План-график/',
        'lop' => 'ЛОП/',
        'lpp' => 'ЛПП/',
        'decision_sheet' => 'Лист решений/',
        'file' => 'Контракт/',
        'technical_task' => 'Тех.задание/',
        'risks' => 'Риски/',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function createRecord($files, $project)
    {
        foreach (self::$contractFiles as $column => $path) {
            if (isset($files[$column])) {
                $file = new File();
                $fileName = File::createName($project->name);
                $file->createFile($files[$column], public_path('Projects_files/' . $project->code . '/Управление проектом/' . $path), $fileName);
                $this->$column = $file->id;
            }
        }

        $this->project_id = $project->id;
        $this->save();
    }

    public function updateRecord($files, $project)
    {
        $original = $this->getOriginal();
        foreach (self::$contractFiles as $column => $path) {
            if (isset($files[$column])) {
                if ($original[$column]) {
                    $file = File::find($original[$column]);
                    $fileSystem = new Filesystem();
                    $fileSystem->delete(public_path('Projects_files/' . $project->code . '/Управление проектом/' . $path . $file->file_name));
                    $file->delete();
                }
                $newFile = new File();
                $fileName = File::createName($project->name);
                $newFile->createFile($files[$column], public_path('Projects_files/' . $project->code . '/Управление проектом/' . $path), $fileName);
                $this->$column = $newFile->id;
            }
        }

        $this->save();
    }

    public function documentStatus()
    {
        return $this->hasOne('App\DocumentStatus', 'contract_id');
    }

    public function serviceStatus()
    {
        return $this->hasOne('App\ServiceStatus', 'contract_id');
    }

    public function financialStatus()
    {
        return $this->hasOne('App\FinancialStatus', 'contract_id');
    }

    public function lopFile()
    {
        return $this->belongsTo('App\File', 'lop');
    }

    public function decreeScan()
    {
        return $this->belongsTo('App\File', 'decree_scan');
    }

    public function projectCharter()
    {
        return $this->belongsTo('App\File', 'project_charter');
    }

    public function planChart()
    {
        return $this->belongsTo('App\File', 'plan_chart');
    }

    public function lppListFile()
    {
        return $this->belongsTo('App\File', 'decision_sheet');
    }

    public function contractFile()
    {
        return $this->belongsTo('App\File', 'file');
    }

    public function technicalTask()
    {
        return $this->belongsTo('App\File', 'technical_task');
    }

    public function riskFile()
    {
        return $this->belongsTo('App\File', 'risks');
    }
}
