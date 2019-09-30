<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CostPlan model for cost_plan table
 * @package App
 */
class CostPlan extends Model
{
    /** @var string $table - table name */
    protected $table = 'cost_plan';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function costs()
    {
        return $this->hasMany('App\Cost', 'plan_id');
    }

    public function balance()
    {
        $sumPlans = Cost::where(['plan_id' => $this->id])->sum('count');
        return $this->plan - $sumPlans;
    }

    public function findPlan($options, $role)
    {
        return $this->when($options['article'], function ($query) use ($options) {
            return $query->where('article', 'LIKE', "%{$options['article']}%");
        })
        ->when($options['project_name'], function ($query) use ($options) {
                $projectIds = Project::where('name', 'LIKE', "%{$options['project_name']}%")->pluck('id')->all();
                return $query->whereIn('project_id', $projectIds);
            })
        ->when($options['project_code'], function ($query) use ($options) {
                $projectCodeIds = Project::where('code', 'LIKE', "%{$options['project_code']}%")->pluck('id')->all();
                return $query->whereIn('project_id', $projectCodeIds);
            })
        ->when($role === 'Оператор', function ($query) {
                $projectHeadIds = Project::where(['head_id' => auth()->user()->id])->pluck('id')->all();
                return $query->whereIn('project_id', $projectHeadIds);
            })->get();
    }
}
