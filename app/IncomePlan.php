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
        $datePay = new DateTime($this->income_date);
        return date_diff($dateNow, $datePay)->format('%r%d');
    }
}
