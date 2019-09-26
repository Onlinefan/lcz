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

    public function vu220()
    {
        return $this->belongsTo('App\Vu220', '220_vu');
    }

    public function linkContract()
    {
        return $this->belongsTo('App\LinkContract', 'link_contract');
    }

    public function dislocationStrapping()
    {
        return $this->belongsTo('App\DislocationStrapping', 'dislocation_strapping');
    }

    public function installationStatus()
    {
        return $this->belongsTo('App\InstallationStatus', 'installation_status');
    }

    public function transferredPnr()
    {
        return $this->belongsTo('App\TransferredPnr', 'transferred_pnr');
    }
}
