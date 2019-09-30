<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IncomePlan model for income_plan table
 * @package App
 */
class IncomePlan extends Model
{
    /** @var string $table - table name */
    protected $table = 'income_plan';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function incomes()
    {
        return $this->hasMany('App\Income', 'plan_id');
    }

    public function balance()
    {
        $sumPlans = Income::where([['plan_id', '=', $this->id], ['payment_status', '=', 'Оплачен']])->sum('count');
        return $this->plan - $sumPlans;
    }

    public function dateDiff()
    {
        $dateNow = new DateTime();
        $datePay = new DateTime($this->income_date ?: 'now');
        return date_diff($dateNow, $datePay)->format('%r%d');
    }

    public function findPlan($options, $role)
    {
        return $this->when($options['name'], function ($query) use ($options) {
            return $query->where('name', 'LIKE', "%{$options['name']}%");
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
