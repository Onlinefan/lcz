<?php

namespace App\Http\Controllers;

use App\AnalysisResult;
use App\AndromedaUnloading;
use App\BelongingRoad;
use App\Calibration2000;
use App\ComplexToMonitoring;
use App\DislocationStrapping;
use App\Document;
use App\File;
use App\FootingRequest;
use App\InCafap;
use App\InitialData;
use App\InstallationStatus;
use App\Kp;
use App\LinkContract;
use App\Pir;
use App\Pnr;
use App\Product;
use App\Production;
use App\Progress;
use App\Project;
use App\ProjectDocument;
use App\ProjectRegion;
use App\ProjectStatus;
use App\RoadType;
use App\ShipmentStatus;
use App\SmrInstallation;
use App\SurveyStatus;
use App\TransferredPnr;
use App\TuRequest;
use App\Vu220;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if ($this->user) {
                if ($this->user->status === 'Ожидает модерации') {
                    return redirect('/moderate');
                } elseif ($this->user->status === 'Заблокирован') {
                    return redirect('/blocked');
                }

                if ($this->user->role === 'Производство') {
                    return redirect('/production_plan');
                } elseif ($this->user->role === 'Секретарь') {
                    return redirect('/statuses');
                } elseif ($this->user->role === 'Бухгалтер') {
                    return redirect('/home');
                }
            }
            return $next($request);
        });
    }

    public function index($id)
    {
        $project = Project::find($id);
        if (intval($project->head_id) !== auth()->user()->id && (auth()->user()->role !== 'Администратор' && auth()->user()->role !== 'Суперпользователь')) {
            return redirect('/projects');
        }

        $countStatuses = Project::select(DB::raw('status, count(*) as status_count'))
            ->where(['head_id' => auth()->user()->id])
            ->groupBy(['status'])->get();
        $income = 0;
        $cost = 0;
        $countPlan = 0;
        $realizationCount = 0;
        $finishCount = 0;
        $incomePay = 0;

        foreach ($countStatuses as $status) {
            if ($status->status === 'Реализация') {
                $realizationCount = $status->status_count;
            } else if ($status->status === 'Завершен') {
                $finishCount = $status->status_count;
            }
        }

        foreach ($project->incomePlans as $incomePlan) {
            foreach ($incomePlan->incomes as $inc) {
                $income += $inc->payment_status === 'Выставлен' ? floatval($inc->count) : floatval(0);
                $incomePay += $inc->payment_status === 'Оплачен' ? floatval($inc->count) : floatval(0);
            }
        }

        foreach ($project->costPlans as $costPlan) {
            foreach ($costPlan->costs as $cos) {
                $cost += floatval($cos->count);
            }
        }

        $now = new DateTime('now');
        $contractEnd = $project->status === 'Реализация' ? new DateTime($project->contract->date_sign_acts) : new DateTime($project->contract->date_end);
        $dateDiff = $now->diff($contractEnd)->format('%r%a');


        $vu220 = '220_vu';

        $projectRegions = ProjectRegion::where(['project_id' => $id])->get();
        $arPercents = $project->projectPercent();

        $datePercent = 0;

        foreach ($arPercents as $region) {
            $datePercent += ($region['dataCount'] / 7 + $region['initialDataCount'] / 5 + $region['pirCount'] / 10 + $region['productionCount'] / 6 + $region['smrCount'] / 6 +
                $region['pnrCount'] / 6 + $region['documentsCount'] / 10) / 7 * 100;
        }

        $datePercent = $datePercent/count($arPercents);
        $products = Product::all();
        $roadTypes = RoadType::all();

        return view('progress', [
            'project' => $project,
            'dateDiff' => $dateDiff,
            'datePercent' =>$datePercent,
            'projectRegions' => $projectRegions,
            'product' => $products,
            'roadTypes' => $roadTypes,
            'income' => $income,
            'cost' => $cost,
            'countPlan' => $countPlan,
            'realizationCount' => $realizationCount,
            'finishCount' => $finishCount,
            'vu220' => $vu220,
            'arPercents' => $arPercents,
            'incomePay' => $incomePay
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Progress::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function show(Progress $progress)
    {
        return $progress;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function edit(Progress $progress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Progress $progress)
    {
        if($progress->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function destroy(Progress $progress)
    {
        if($progress->delete()){
            return true;
        }
    }

    public function editData($id)
    {
        $projectStatus = ProjectStatus::find($id);
        $roadTypes = BelongingRoad::all();

        return view('edit-data', [
            'projectStatus' => $projectStatus,
            'roadTypes' => $roadTypes,
        ]);
    }

    public function createData(Request $request)
    {
        $class = $request->get('table');

        /** @var Model $object */
        $object = $class::find($request->get('id'));

        $arRequest = $request->all();
        unset($arRequest['_token']);
        unset($arRequest['table']);
        unset($arRequest['id']);

        $object->setRawAttributes($arRequest);
        $object->save();

        if ($request->get('project_id')) {
            return redirect('/progress/' . $request->get('project_id'));
        } else {
            $projectStatus = ProjectStatus::find($request->get('complex_id'));
            return redirect('/progress/' . $projectStatus->project_id);
        }

    }

    public function editInitialData($id)
    {
        $initialData = InitialData::find($id);
        $roadTypes = RoadType::all();
        $products = Product::all();

        return view('edit-initial-data', [
            'initialData' => $initialData,
            'roadTypes' => $roadTypes,
            'products' => $products,
        ]);
    }

    public function editPir($id)
    {
        $pir = Pir::find($id);
        $surveyStatuses = SurveyStatus::all();
        $projectDocuments = ProjectDocument::all();
        $tuRequests = TuRequest::all();
        $footingRequests = FootingRequest::all();
        return view('edit-pir' , [
            'pir' => $pir,
            'surveyStatuses' => $surveyStatuses,
            'projectDocuments' => $projectDocuments,
            'tuRequests' => $tuRequests,
            'footingRequests' => $footingRequests,
        ]);
    }

    public function editProduction($id)
    {
        $production = Production::find($id);
        $shipmentStatuses = ShipmentStatus::all();

        return view('edit-production', [
            'production' => $production,
            'shipmentStatuses' => $shipmentStatuses
        ]);
    }

    public function editSmr($id)
    {
        $smr = SmrInstallation::find($id);
        $vu220 = Vu220::all();
        $linkContract = LinkContract::all();
        $dislocationStrapping = DislocationStrapping::all();
        $installationStatus = InstallationStatus::all();
        $transferredPnr = TransferredPnr::all();

        return view('edit-smr', [
            'smr' => $smr,
            'vu220' => $vu220,
            'linkContract' => $linkContract,
            'dislocationStrapping' => $dislocationStrapping,
            'installationStatus' => $installationStatus,
            'transferredPnr' => $transferredPnr,
            'vuTable' => '220_vu'
        ]);
    }

    public function editPnr($id)
    {
        $pnr = Pnr::find($id);
        $calibration2000 = Calibration2000::all();
        $kps = Kp::all();
        $analysisResult = AnalysisResult::all();
        $complexToMonitoring = ComplexToMonitoring::all();
        $andromedaUnloading = AndromedaUnloading::all();
        $inCafap = InCafap::all();

        return view('edit-pnr', [
            'pnr' => $pnr,
            'calibration2000' => $calibration2000,
            'kps' => $kps,
            'analysisResult' => $analysisResult,
            'complexToMonitoring' => $complexToMonitoring,
            'andromedaUnloading' => $andromedaUnloading,
            'inCafap' => $inCafap
        ]);
    }

    public function createDocuments(Request $request)
    {
        /** @var Document $documents */
        $documents = Document::find($request->get('id'));
        $projectStatus = ProjectStatus::find($request->get('complex_id'));
        $project = Project::find($projectStatus->project_id);

        $documents->complex_id = $request->get('complex_id');
        $documents->updateRecord($request, $project);
        return redirect('/progress/' . $project->id);
    }

    public function editDocuments($id)
    {
        $documents = Document::find($id);

        return view('edit-documents', [
            'documents' => $documents,
        ]);
    }

    public function addRow($projectId, $regionId)
    {
        $projectStatus = new ProjectStatus(['project_id' => $projectId, 'region_id' => $regionId]);
        $projectStatus->save();
        $initialData = new InitialData(['complex_id' => $projectStatus->id]);
        $initialData->save();
        $pnr = new Pnr(['complex_id' => $projectStatus->id]);
        $pnr->save();
        $pir = new Pir(['complex_id' => $projectStatus->id]);
        $pir->save();
        $production = new Production(['complex_id' => $projectStatus->id]);
        $production->save();
        $smrInstallation = new SmrInstallation(['complex_id' => $projectStatus->id]);
        $smrInstallation->save();
        $document = new Document(['complex_id' => $projectStatus->id]);
        $document->save();

        return redirect('/progress/' . $projectId);
    }

    public function deleteDataRow($id)
    {
        $projectStatus = ProjectStatus::find($id);
        $projectId = $projectStatus->project_id;
        $projectStatus->delete();
        InitialData::where(['complex_id' => $id])->delete();
        Pir::where(['complex_id' => $id])->delete();
        Production::where(['complex_id' => $id])->delete();
        SmrInstallation::where(['complex_id' => $id])->delete();
        Pnr::where(['complex_id' => $id])->delete();
        Document::where(['complex_id' => $id])->delete();

        return redirect('/progress/' . $projectId);
    }
}
