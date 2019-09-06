<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        foreach ($arCollage as $collage) {
            $file = new File();
            $fileName = File::createName($project->name);
            $file->createFile($collage, public_path('/Проекты/' . $project->code . '/Управление проектом/Коллаж/'), $fileName);
            self::createRecord($cafapId, $file->id);
        }
    }

    public static function createRecord($cafapId, $fileId)
    {
        $collage = new CafapCollage(['cafap_id' => $cafapId, 'file' => $fileId]);
        $collage->save();
    }
}
