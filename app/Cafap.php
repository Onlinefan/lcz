<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;

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
            if (isset($arCafap[$column])) {
                $file = new File();
                $fileName = File::createName($project->name);
                $file->createFile($arCafap[$column], public_path('/Проекты/' . $project->code . '/Управление проектом/' . $path), $fileName);
                $this->$column = $file->id;
            }
        }

        $this->project_id = $project->id;
        $this->save();
    }

    public function updateRecord($arCafap, $project)
    {
        foreach (self::$cafapFiles as $column => $path) {
            if (isset($arCafap[$column])) {
                $file = File::find($this->$column);
                $fileSystem = new Filesystem();
                $fileSystem->delete(public_path('/Проекты/' . $project->code . '/Управление проектом/' . $path . $file->file_name));
                $newFile = new File();
                $fileName = File::createName($project->name);
                $newFile->createFile($arCafap[$column], public_path('/Проекты/' . $project->code . '/Управление проектом/' . $path), $fileName);
                $this->$column = $newFile->id;
                $file->delete();
            }
        }

        $this->save();
    }

    public function dataTransfer()
    {
        return $this->belongsTo('App\File', 'data_transfer_scheme');
    }

    public function locationDirections()
    {
        return $this->belongsTo('App\File', 'location_directions');
    }

    public function speedMode()
    {
        return $this->belongsTo('App\File', 'speed_mode');
    }

    public function cafapCollage()
    {
        return $this->hasMany('App\CafapCollage', 'cafap_id');
    }

    public function cafapRegions()
    {
        return $this->hasMany('App\CafapRegion', 'cafap_id');
    }

    public function  cafapAndromeda()
    {
        return $this->hasMany('App\CafapAndromedaExist', 'cafap_id');
    }
}
