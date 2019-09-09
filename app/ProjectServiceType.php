<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectServiceType model for project_service_types table
 * @package App
 */
class ProjectServiceType extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_service_types';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    public static function createRecords($arTypes, $projectId)
    {
        foreach ($arTypes as $typeId) {
            self::createRecord($typeId, $projectId);
        }
    }

    public static function createRecord($typeId, $projectId)
    {
        $model = new ProjectServiceType(['project_id' => $projectId, 'service_type_id' => $typeId]);
        $model->save();
    }

    public function serviceType()
    {
        return $this->belongsTo('App\ServiceType', 'service_type_id');
    }
}
