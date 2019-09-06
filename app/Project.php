<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project model for projects table
 * @package App
 */
class Project extends Model
{
    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function head()
    {
        return $this->belongsTo('App\User');
    }

    public function createRecord()
    {
        $this->code = 'somecode';
        $this->save();
        $codeStr = strval($this->id);
        while (strlen($codeStr) < 4) {
            $codeStr = '0' . $codeStr;
        }

        $this->code = 'ID' . $codeStr;
        $this->save();

        return $this;
    }
}
