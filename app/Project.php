<?php

namespace App;

use DateTime;
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

    public function regions()
    {
        return $this->hasMany('App\ProjectRegion', 'project_id');
    }

    public function serviceType()
    {
        return $this->hasMany('App\ProjectServiceType', 'project_id');
    }

    public function contract()
    {
        return $this->hasOne('App\Contract');
    }

    public function countries()
    {
        return $this->hasMany('App\ProjectCountry', 'project_id');
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

    public function products()
    {
        return $this->hasMany('App\ProjectProductCount');
    }

    public function incomePlans()
    {
        return $this->hasMany('App\IncomePlan', 'project_id');
    }

    public function costPlans()
    {
        return $this->hasMany('App\CostPlan', 'project_id');
    }

    public function responsibilityArea()
    {
        return $this->hasOne('App\ProjectResponsibilityArea', 'project_id');
    }

    public function cafap()
    {
        return $this->hasOne('App\Cafap', 'project_id');
    }

    public function productionPlan()
    {
        return $this->hasMany('App\ProductionPlan', 'project_id');
    }

    public function contacts()
    {
        return $this->hasMany('App\ProjectContact');
    }

    public function messages()
    {
        return $this->hasMany('App\ProjectMessage');
    }

    public function incomeSum()
    {
        $incomeSum = 0;
        foreach ($this->incomePlans as $plan) {
            $incomeSum += $plan->payed;
        }

        return $incomeSum;
    }

    public function deadline()
    {
        $now = new DateTime('now');
        $contractEnd = new DateTime($this->contract->date_end);
        $dateDiff = $contractEnd->diff($now)->format('%a');
        return $dateDiff;
    }
}
