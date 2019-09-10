<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OtherContract model for other_contracts table
 * @package App
 */
class OtherContract extends Model
{
    /** @var string $table - table name */
    public $table = 'other_contracts';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    public function contractFile()
    {
        return $this->belongsTo('App\File', 'contract');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
