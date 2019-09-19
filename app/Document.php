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
        'examination' => 'Obsledovanie',
        'project_documentation' => 'Proektnaya documentaciya',
        'executive_documentation' => 'Ispolnitelnaya documentaciya',
        'verification' => 'Poverka',
        'forms' => 'Formulyary',
        'passports' => 'Pasporta',
        'tu_220' => 'TU-220',
        'contract_220' => 'Dogovor 220',
        'tu_footing' => 'TU na oporu',
        'contract_footing' => 'Dogovor na opory',
        'address_plan_agreed_cafap' => 'Adresnyi plan',
        'data_transfer_scheme' => 'Shema peredachi dannyh',
        'inbox' => 'Vhodyashie',
        'outgoing' => 'Ishodyashie'
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
                    $fileSystem->delete(public_path('/Projects_files/' . $project->code . '/Upravleniye proektom/' . $path . $file->file_name));
                }
                $newFile = new File();
                $fileName = File::createName($project->name);
                $newFile->createFile($request->file($column), public_path('/Projects_files/' . $project->code . '/Upravleniye proektom/' . $path), $fileName);
                $this->$column = $newFile->id;
                if ($file) {
                    $file->delete();
                }
            }
        }

        $this->save();
    }
}
