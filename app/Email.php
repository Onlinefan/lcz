<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Email model for emails table
 * @package App
 */
class Email extends Model
{
    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    public function getDates()
    {
        return array_merge(parent::getDates(), ['email_date']);
    }

    public function letterFile()
    {
        return $this->belongsTo('App\File', 'letter_file');
    }
}
