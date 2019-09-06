<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cafap model for cafap table
 * @package App
 */
class Cafap extends Model
{
    /** @var string $table - table name */
    protected $table = 'cafap';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /** @var array $cafapFiles -  Correlates table columns and file location paths*/
    private static $cafapFiles = [
        'data_transfer_scheme' => 'Схема передачи данных/',
        'location_directions' => 'Дислокация и направление/',
        'speed_mode' => 'Скоростной режим/'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function createRecord($arCafap, $project)
    {
        foreach (self::$cafapFiles as $column => $path) {
            $file = new File();
            $fileName = File::createName($project->name);
            $file->createFile($arCafap[$column], public_path('/Проекты/' . $project->code . '/Управление проектом/' . $path), $fileName);
            $this->$column = $file->id;
        }

        $this->project_id = $project->id;
        $this->save();
    }
}
