<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectDocument extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_documents';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
