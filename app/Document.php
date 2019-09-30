<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

/**
 * Class Document model for documents table
 * @package App
 */
class Document extends Model
{
    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    public static $paths = [
        'examination' => 'Обследование',
        'project_documentation' => 'Проектная документация',
        'executive_documentation' => 'Исполнительная документация',
        'verification' => 'Поверка',
        'forms' => 'Формуляры',
        'passports' => 'Паспорта',
        'tu_220' => 'ТУ-220',
        'contract_220' => 'Договор 220',
        'tu_footing' => 'ТУ на опору',
        'contract_footing' => 'Договор на опору',
        'address_plan_agreed_cafap' => 'Адресный план',
        'data_transfer_scheme' => 'Схема передачи данных',
        'inbox' => 'Входящие',
        'outgoing' => 'Исходящие'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function updateRecord(Request $request, $project)
    {
        foreach (self::$paths as $column => $path) {
            if ($request->file($column)) {
                $file = File::find($this->$column);
                if ($file) {
                    $fileSystem = new Filesystem();
                    $fileSystem->delete(public_path('/Projects_files/' . $project->code . '/Управление проектом/' . $path . $file->file_name));
                }
                $newFile = new File();
                $fileName = File::createName($project->name);
                $newFile->createFile($request->file($column), public_path('/Projects_files/' . $project->code . '/Управление проектом/' . $path), $fileName);
                $this->$column = $newFile->id;
                if ($file) {
                    $file->delete();
                }
            }
        }

        $this->save();
    }

    public function examinationFile()
    {
        return $this->belongsTo('App\File', 'examination');
    }

    public function projectDocumentationFile()
    {
        return $this->belongsTo('App\File', 'project_documentation');
    }

    public function executiveDocumentationFile()
    {
        return $this->belongsTo('App\File', 'executive_documentation');
    }

    public function verificationFile()
    {
        return $this->belongsTo('App\File', 'verification');
    }

    public function formsFile()
    {
        return $this->belongsTo('App\File', 'forms');
    }

    public function passportsFile()
    {
        return $this->belongsTo('App\File', 'passports');
    }

    public function tu220File()
    {
        return $this->belongsTo('App\File', 'tu_220');
    }

    public function contract220File()
    {
        return $this->belongsTo('App\File', 'contract_220');
    }

    public function tuFootingFile()
    {
        return $this->belongsTo('App\File', 'tu_footing');
    }

    public function contractFootingFile()
    {
        return $this->belongsTo('App\File', 'contract_footing');
    }

    public function addressPlanAgreedCafapFile()
    {
        return $this->belongsTo('App\File', 'address_plan_agreed_cafap');
    }

    public function dataTransferSchemeFile()
    {
        return $this->belongsTo('App\File', 'data_transfer_scheme');
    }

    public function inboxFile()
    {
        return $this->belongsTo('App\File', 'inbox');
    }

    public function outgoingFile()
    {
        return $this->belongsTo('App\File', 'outgoing');
    }
}
