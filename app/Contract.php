<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class Contract model for contracts table
 * @package App
 */
class Contract extends Model
{
    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

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
                $file->createFile($files[$column], public_path('Проекты/' . $project->code . '/Управление проектом/' . $path), $fileName);
                $this->$column = $file->id;
            }
        }

        $this->project_id = $project->id;
        $this->save();
    }

    public function lppFile()
    {
        return $this->belongsTo('App\File', 'lpp');
    }
}
