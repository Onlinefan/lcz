<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectContact model for project_contacts table
 * @package App
 */
class ProjectContact extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_contacts';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public static function createRecords($arContacts, $projectId)
    {
        foreach ($arContacts['fio'] as $key => $fio) {
            $contact = Contact::firstOrCreate([
                'fio' => $fio,
                'position' => $arContacts['position'][$key],
                'mobile_number' => $arContacts['mobile_number'][$key],
                'work_number' => $arContacts['work_number'][$key],
                'email' => $arContacts['email'][$key],
                'address' => $arContacts['address'][$key],
                'company' => $arContacts['company'][$key],]);

            $projectContacts = new ProjectContact([
                'contact_id' => $contact->id,
                'project_id' => $projectId
            ]);

            $projectContacts->save();
        }
    }
}
