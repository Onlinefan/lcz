<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;

/**
 * Class CafapCollage model for cafap_collage table
 * @package App
 */
class CafapCollage extends Model
{
    /** @var string $table - table name */
    protected $table = 'cafap_collage';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cafap()
    {
        return $this->belongsTo('App\Cafap');
    }

    public static function createRecords($arCollage, $cafapId, $project)
    {
        if ($arCollage) {
            foreach ($arCollage as $collage) {
                $file = new File();
                $fileName = File::createName($project->name);
                $file->createFile($collage, public_path('/Проекты/' . $project->code . '/Управление проектом/Коллаж/'), $fileName);
                self::createRecord($cafapId, $file->id);
            }
        }
    }

    public static function createRecord($cafapId, $fileId)
    {
        $collage = new CafapCollage(['cafap_id' => $cafapId, 'file' => $fileId]);
        $collage->save();
    }

    public static function updateRecords($arCollage, $cafapId, $project)
    {
        if (isset($arCollage)) {
            $oldCollage = CafapCollage::where(['cafap_id' => $cafapId])->get();
            $fileSystem = new Filesystem();
            $fileIds = [];
            foreach ($oldCollage as $collage) {
                $fileSystem->delete(public_path('Проекты/' . $project->code . '/Управление проектом/Коллаж' . $collage->collageFile->file_name));
                $fileIds[] = $collage->collageFile->id;
                $collage->delete();
            }

            if ($fileIds) {
                File::find($fileIds)->delete();
            }

            self::createRecords($arCollage, $cafapId, $project);
        }
    }

    public function collageFile()
    {
        return $this->belongsTo('App\File', 'file');
    }
}
