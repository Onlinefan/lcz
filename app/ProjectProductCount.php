<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectProductCount model for project_products_count
 * @package App
 */
class ProjectProductCount extends Model
{
    /** @var string $table - table name */
    protected $table = 'project_products_count';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
