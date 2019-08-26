<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SmrInstallation model for smr_installation table
 * @package App
 */
class SmrInstallation extends Model
{
    /** @var string $table - table name */
    protected $table = 'smr_installation';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
