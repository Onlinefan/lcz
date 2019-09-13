<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectResponsibilityArea model for project_responsibility_area table
 * @package App
 */
class ProjectResponsibilityArea extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_responsibility_area';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public static function createRecord($arResponsibility, $projectId)
    {
        $projectResponsibility = new ProjectResponsibilityArea([
            'project_id' => $projectId,
            'examination' => isset($arResponsibility['examination_other']) ? $arResponsibility['examination_other'] : $arResponsibility['examination_main'],
            'smr' => isset($arResponsibility['smr_other']) ? $arResponsibility['smr_other'] : $arResponsibility['smr_main'],
            'installation' => isset($arResponsibility['installation_other']) ? $arResponsibility['installation_other'] : $arResponsibility['installation_main'],
            'pnr' => isset($arResponsibility['pnr_other']) ? $arResponsibility['pnr_other'] : $arResponsibility['pnr_main'],
            'support_permission' => isset($arResponsibility['support_permission_other']) ? $arResponsibility['support_permission_other'] : $arResponsibility['support_permission_main'],
            'tu_220' => isset($arResponsibility['tu_220_other']) ? $arResponsibility['tu_220_other'] : $arResponsibility['tu_220_main'],
            'tu_communication' => isset($arResponsibility['tu_communication_other']) ? $arResponsibility['tu_communication_other'] : $arResponsibility['tu_communication_main']
        ]);

        $projectResponsibility->save();
    }

    public static function updateRecord($arResponsibility, $projectId)
    {
        $projectResponsibility = ProjectResponsibilityArea::where(['project_id' => $projectId])->first();
        $projectResponsibility->setRawAttributes([
            'examination' => isset($arResponsibility['examination_other']) ? $arResponsibility['examination_other'] : $arResponsibility['examination_main'],
            'smr' => isset($arResponsibility['smr_other']) ? $arResponsibility['smr_other'] : $arResponsibility['smr_main'],
            'installation' => isset($arResponsibility['installation_other']) ? $arResponsibility['installation_other'] : $arResponsibility['installation_main'],
            'pnr' => isset($arResponsibility['pnr_other']) ? $arResponsibility['pnr_other'] : $arResponsibility['pnr_main'],
            'support_permission' => isset($arResponsibility['support_permission_other']) ? $arResponsibility['support_permission_other'] : $arResponsibility['support_permission_main'],
            'tu_220' => isset($arResponsibility['tu_220_other']) ? $arResponsibility['tu_220_other'] : $arResponsibility['tu_220_main'],
            'tu_communication' => isset($arResponsibility['tu_communication_other']) ? $arResponsibility['tu_communication_other'] : $arResponsibility['tu_communication_main']
        ]);

        $projectResponsibility->save();
    }
}
