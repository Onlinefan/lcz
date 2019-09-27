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
        if ($this->status === 'Эксплуатация') {
            $this->exploitation_id = $this->head_id;
        } else {
            $this->realization_id = $this->head_id;
        }

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

    public function incomes()
    {
        $incomeIds = IncomePlan::where(['project_id' => $this->id])->pluck('id')->all();

        $incomes = Income::whereIn('plan_id', $incomeIds)->where(['payment_status' => 'Оплачен'])->get();
        return $incomes;
    }

    public function fulfilledObligations()
    {
        $incomeIds = IncomePlan::where(['project_id' => $this->id])->pluck('id')->all();

        $sumIncomes = Income::whereIn('plan_id', $incomeIds)->sum('count');
        return $sumIncomes;
    }

    public function paidWork()
    {
        $incomeIds = IncomePlan::where(['project_id' => $this->id])->pluck('id')->all();

        $sumIncomes = Income::whereIn('plan_id', $incomeIds)->where(['payment_status' => 'Оплачен'])->sum('count');
        return $sumIncomes;
    }

    public function futurePay()
    {
        return $this->contract->amount - $this->paidWork();
    }

    public function costs()
    {
        $costIds = CostPlan::where(['project_id' => $this->id])->pluck('id')->all();

        $sumCost = Cost::whereIn('plan_id', $costIds)->sum('count');
        return $sumCost;
    }

    public function linearCount()
    {
        $sumProducts = ProjectProductCount::where([['project_id', '=', $this->id], ['road_id', '=', 1]])->sum('count');
        return $sumProducts;
    }

    public function perekrestokCount()
    {
        $sumProducts = ProjectProductCount::where([['project_id', '=', $this->id], ['road_id', '=', 2]])->sum('count');
        return $sumProducts;
    }

    public function peshehodCount()
    {
        $sumProducts = ProjectProductCount::where([['project_id', '=', $this->id], ['road_id', '=', 3]])->sum('count');
        return $sumProducts;
    }

    public function pereezdCount()
    {
        $sumProducts = ProjectProductCount::where([['project_id', '=', $this->id], ['road_id', '=', 4]])->sum('count');
        return $sumProducts;
    }

    public function koppCount()
    {
        $sumProducts = ProjectProductCount::where([['project_id', '=', $this->id], ['product_id', '=', 4]])->sum('count');
        return $sumProducts;
    }

    public function kopsCount()
    {
        $sumProducts = ProjectProductCount::where([['project_id', '=', $this->id], ['product_id', '=', 3]])->sum('count');
        return $sumProducts;
    }

    public function arhimedCount()
    {
        $sumProducts = ProjectProductCount::where([['project_id', '=', $this->id], ['product_id', '=', 5]])->sum('count');
        return $sumProducts;
    }

    public function surveyPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Pir::whereIn('complex_id', $complexIds)->where(['survey_status' => 3])->count();
            $surveyCount = Pir::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }

    }

    public function documentPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Pir::whereIn('complex_id', $complexIds)->whereIn('design_documentation', [2, 1])->count();
            $surveyCount = Pir::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function tuPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Pir::whereIn('complex_id', $complexIds)->whereIn('request_tu', [2, 4])->count();
            $surveyCount = Pir::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function footingPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Pir::whereIn('complex_id', $complexIds)->whereIn('request_footing', [1, 3])->count();
            $surveyCount = Pir::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }

    }

    public function shipmentPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Production::whereIn('complex_id', $complexIds)->whereIn('shipment_status', [3, 4])->count();
            $surveyCount = Production::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function checkPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Production::whereIn('complex_id', $complexIds)->whereNotNull('number_verification')->count();
            $surveyCount = Production::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function tuFootingPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Document::whereIn('complex_id', $complexIds)->where('tu_footing', '<>', 'Не требуется')->count();
            $surveyCount = Document::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function tu220Percent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Document::whereIn('complex_id', $complexIds)->where('tu_220', '<>', 'Не требуется')->count();
            $surveyCount = Document::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } return 0;
        } else {
            return 0;
        }
    }

    public function installPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = SmrInstallation::whereIn('complex_id', $complexIds)->where(['installation_status' => 3])->count();
            $surveyCount = SmrInstallation::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function vu220Percent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = SmrInstallation::whereIn('complex_id', $complexIds)->where(['220_vu' => 2])->count();
            $surveyCount = SmrInstallation::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function transferredPnrPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = SmrInstallation::whereIn('complex_id', $complexIds)->where(['transferred_pnr' => 1])->count();
            $surveyCount = SmrInstallation::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function kpPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Pnr::whereIn('complex_id', $complexIds)->where(['kp' => 3])->count();
            $surveyCount = Pnr::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function analysisPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Pnr::whereIn('complex_id', $complexIds)->where(['analysis_result' => 2])->count();
            $surveyCount = Pnr::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function monitoringPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Pnr::whereIn('complex_id', $complexIds)->where(['complex_to_monitoring' => 2])->count();
            $surveyCount = Pnr::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function inCafapPercent($regionId)
    {
        $complexIds = ProjectStatus::where([['project_id', '=', $this->id], ['region_id', '=', $regionId]])->pluck('id')->all();
        if ($complexIds) {
            $surveyDone = Pnr::whereIn('complex_id', $complexIds)->where(['in_cafap' => 1])->count();
            $surveyCount = Pnr::whereIn('complex_id', $complexIds)->count();
            if ($surveyCount) {
                $percent = round($surveyDone/$surveyCount*100, 2);
                return $percent;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}
