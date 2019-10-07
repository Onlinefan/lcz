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

    public function projectPercent()
    {
        $arPercents = [];
        $vu220 = '220_vu';
        $projectRegions = ProjectRegion::where(['project_id' => $this->id])->get();
        foreach ($projectRegions as $region) {
            $dataCount = 0;
            $initialDataCount = 0;
            $pirCount = 0;
            $productionCount = 0;
            $smrCount = 0;
            $pnrCount = 0;
            $documentsCount = 0;
            foreach ($region->projectStatus() as $projectStatus) {
                $dataCount += isset($projectStatus->system_number);
                $dataCount += isset($projectStatus->system_id);
                $dataCount += isset($projectStatus->complex_id);
                $dataCount += isset($projectStatus->city);
                $dataCount += isset($projectStatus->affiliation_of_the_road);
                $dataCount += isset($projectStatus->address_contract);
                $dataCount += isset($projectStatus->address_gibdd);

                $initialDataCount += isset($projectStatus->initialData->equipment_type);
                $initialDataCount += isset($projectStatus->initialData->road_type);
                $initialDataCount += isset($projectStatus->initialData->speed_mode);
                $initialDataCount += isset($projectStatus->initialData->borders_number);
                $initialDataCount += isset($projectStatus->initialData->koap);

                $pirCount += isset($projectStatus->pir->survey_status);
                $pirCount += isset($projectStatus->pir->survey_comment);
                $pirCount += isset($projectStatus->pir->design_documentation);
                $pirCount += isset($projectStatus->pir->new_footing_fvf);
                $pirCount += isset($projectStatus->pir->new_footing_lep);
                $pirCount += isset($projectStatus->pir->rk_count);
                $pirCount += isset($projectStatus->pir->ok_count);
                $pirCount += isset($projectStatus->pir->equipment_power);
                $pirCount += isset($projectStatus->pir->request_tu);
                $pirCount += isset($projectStatus->pir->request_footing);

                $productionCount += isset($projectStatus->production->shipment_status);
                $productionCount += isset($projectStatus->production->date_equipment_shipment);
                $productionCount += isset($projectStatus->production->number_sim_internet);
                $productionCount += isset($projectStatus->production->number_sim_ssu);
                $productionCount += isset($projectStatus->production->number_verification);
                $productionCount += isset($projectStatus->production->date_verification_end);

                $smrCount += isset($projectStatus->smr->link_root_task);
                $smrCount += isset($projectStatus->smr->$vu220);
                $smrCount += isset($projectStatus->smr->link_contract);
                $smrCount += isset($projectStatus->smr->dislocation_strapping);
                $smrCount += isset($projectStatus->smr->installation_status);
                $smrCount += isset($projectStatus->smr->transferred_pnr);

                $pnrCount += (isset($projectStatus->pnr->calibration_2000) && (int)$projectStatus->pnr->calibration_2000 === 2);
                $pnrCount += isset($projectStatus->pnr->kp);
                $pnrCount += (isset($projectStatus->pnr->analysis_result) && (int)$projectStatus->pnr->analysis_result === 6);
                $pnrCount += isset($projectStatus->pnr->complex_to_monitoring);
                $pnrCount += (isset($projectStatus->pnr->andromeda_unloading) && (int)$projectStatus->pnr->andromeda_unloading === 4);
                $pnrCount += isset($projectStatus->pnr->in_cafap);

                $documentsCount += isset($projectStatus->document->examinationFile);
                $documentsCount += isset($projectStatus->document->projectDocumentationFile);
                $documentsCount += isset($projectStatus->document->executiveDocumentationFile);
                $documentsCount += isset($projectStatus->document->verificationFile);
                $documentsCount += isset($projectStatus->document->formsFile);
                $documentsCount += isset($projectStatus->document->passportsFile);
                $documentsCount += isset($projectStatus->document->tu220File);
                $documentsCount += isset($projectStatus->document->contract220File);
                $documentsCount += isset($projectStatus->document->tuFootingFile);
                $documentsCount += isset($projectStatus->document->contractFootingFile);
            }

            $arPercents[] = [
                'dataCount' => $dataCount,
                'initialDataCount' => $initialDataCount,
                'pirCount' => $pirCount,
                'productionCount' => $productionCount,
                'smrCount' => $smrCount,
                'pnrCount' => $pnrCount,
                'documentsCount' => $documentsCount
            ];
        }

        return $arPercents;
    }
}
