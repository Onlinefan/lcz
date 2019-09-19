<?php

namespace App\Http\Controllers;

use App\AnalysisResult;
use App\AndromedaUnloading;
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
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        foreach ($countStatuses as $status) {
            if ($status->status === 'Реализация') {
                $realizationCount = $status->status_count;
            } else if ($status->status === 'Завершен') {
                $finishCount = $status->status_count;
            }
        }

        foreach ($project->incomePlans as $incomePlan) {
            $income += floatval($incomePlan->payed);
        }

        foreach ($project->costPlans as $costPlan) {
            $cost += floatval($costPlan->count);
            $countPlan += floatval($costPlan->plan);
        }

        $now = new DateTime('now');
        $contractEnd = new DateTime($project->contract->date_end);
        $contractStart = new DateTime($project->contract->date_start);
        $dateDiff = $contractEnd->diff($now)->format('%a');
        $datePercent = $now->diff($contractStart)->format('%a')/$contractEnd->diff($contractStart)->format('%a')*100;

        $projectRegionsQuery = DB::raw("SELECT regions.id AS region_id, regions.name AS region_name, `ps`.id AS system_number, `ps`.system_id, `ps`.complex_id, `ps`.city,
            `ps`.affiliation_of_the_road, `ps`.address_contract, `ps`.address_gibdd, `id`.equipment_type, `id`.road_type, `id`.speed_mode, `id`.borders_number, `id`.koap,
            `id`.stoplines_count, pir.survey_status, pir.survey_comment, pir.design_documentation, pir.new_footing_fvf, pir.new_footing_lep, pir.rk_count, pir.ok_count,
            pir.equipment_power, pir.request_tu, pir.request_footing, pd.shipment_status, pd.date_equipment_shipment, pd.number_sim_internet, pd.number_sim_ssu, pd.number_verification,
            pd.date_verification_end, `si`.link_root_task, `si`.`220_vu`, `si`.link_contract, `si`.dislocation_strapping, `si`.installation_status, `si`.transferred_pnr,
            pnr.calibration_2000, pnr.kp, pnr.analysis_result, pnr.complex_to_monitoring, pnr.andromeda_unloading, pnr.unloading, pnr.in_cafap, doc1.examination, doc2.project_documentation,
            doc3.executive_documentation, doc4.verification, doc5.forms, doc6.passports, doc7.tu_220, doc8.contract_220, doc9.tu_footing, doc10.contract_footing,
            doc11.address_plan_agreed_cafap, doc12.data_transfer_scheme, doc13.inbox, doc14.outgoing FROM regions
            LEFT JOIN (
                SELECT regions.id, `ps`.id AS system_number, system_id, complex_id, city, road_types.name as affiliation_of_the_road, address_contract, address_gibdd
                FROM project_status AS `ps`
                    RIGHT JOIN regions ON `ps`.region_id = regions.id
                    RIGHT JOIN road_types ON `ps`.affiliation_of_the_road = road_types.id
            ) `ps` ON `ps`.id = regions.id
            LEFT JOIN (
                SELECT regions.id, products.name as equipment_type,road_types.name as road_type, speed_mode, borders_number, koap, stoplines_count
                FROM initial_data AS `ps`
                    RIGHT JOIN regions ON `ps`.region_id = regions.id
                    RIGHT JOIN products ON `ps`.equipment_type = products.id
                    RIGHT JOIN road_types ON `ps`.road_type = road_types.id
            ) `id` ON `id`.id = regions.id
            LEFT JOIN (
                SELECT regions.id, survey_statuses.name as survey_status, survey_comment, project_documents.name as design_documentation, new_footing_fvf, new_footing_lep, rk_count,
                equipment_power, ok_count, tu_requests.name as request_tu, footing_requests.name as request_footing
                FROM pir
                    RIGHT JOIN regions ON pir.region_id = regions.id
                    RIGHT JOIN survey_statuses ON pir.survey_status = survey_statuses.id
                    RIGHT JOIN project_documents ON pir.design_documentation = project_documents.id
                    RIGHT JOIN tu_requests ON pir.request_tu = tu_requests.id
                    RIGHT JOIN footing_requests ON pir.request_footing = footing_requests.id
            ) pir ON pir.id = regions.id
            LEFT JOIN (
                SELECT regions.id, shipment_statuses.name shipment_status, date_equipment_shipment, number_sim_internet, number_sim_ssu, number_verification, date_verification_end
                FROM production AS pd
                    RIGHT JOIN regions ON pd.region_id = regions.id
                    RIGHT JOIN shipment_statuses ON pd.shipment_status = shipment_statuses.id
            ) pd ON pd.id = regions.id
            LEFT JOIN (
                SELECT regions.id, link_root_task, vu_200.name as 220_vu, link_contract.name as link_contract, dislocation_strapping.name as dislocation_strapping,
                installation_status.name as installation_status, transferred_pnr.name as transferred_pnr
                FROM smr_installation AS `si`
                    RIGHT JOIN regions ON `si`.region_id = regions.id
                    RIGHT JOIN vu_200 ON `si`.`220_vu` = vu_200.id
                    RIGHT JOIN link_contract ON `si`.link_contract = link_contract.id
                    RIGHT JOIN dislocation_strapping ON `si`.dislocation_strapping = dislocation_strapping.id
                    RIGHT JOIN installation_status ON `si`.installation_status = installation_status.id
                    RIGHT JOIN transferred_pnr ON `si`.transferred_pnr = transferred_pnr.id
            ) `si` ON `si`.id = regions.id
            LEFT JOIN (
                SELECT regions.id, calibration_2000.name as calibration_2000, kp.name as kp, analysis_result.name as analysis_result, complex_to_monitoring.name as complex_to_monitoring,
                andromeda_unloading.name as andromeda_unloading, unloading, in_cafap.name as in_cafap
                FROM pnr
                    RIGHT JOIN regions ON pnr.region_id = regions.id
                    RIGHT JOIN calibration_2000 ON pnr.calibration_2000 = calibration_2000.id
                    RIGHT JOIN kp ON pnr.kp = kp.id
                    RIGHT JOIN analysis_result ON pnr.analysis_result = analysis_result.id
                    RIGHT JOIN complex_to_monitoring ON pnr.complex_to_monitoring = complex_to_monitoring.id
                    RIGHT JOIN andromeda_unloading ON pnr.andromeda_unloading = andromeda_unloading.id
                    RIGHT JOIN in_cafap ON pnr.in_cafap = in_cafap.id
            ) pnr ON pnr.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as examination FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.examination = files.id
            ) doc1 ON doc1.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as project_documentation FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.project_documentation = files.id
            ) doc2 ON doc2.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as executive_documentation FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.executive_documentation = files.id
            ) doc3 ON doc3.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as verification FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.verification = files.id
            ) doc4 ON doc4.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as forms FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.forms = files.id
            ) doc5 ON doc5.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as passports FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.passports = files.id
            ) doc6 ON doc6.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as tu_220 FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.tu_220 = files.id
            ) doc7 ON doc7.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as contract_220 FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.contract_220 = files.id
            ) doc8 ON doc8.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as tu_footing FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.tu_footing = files.id
            ) doc9 ON doc9.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as contract_footing FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.contract_footing = files.id
            ) doc10 ON doc10.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as address_plan_agreed_cafap FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.address_plan_agreed_cafap = files.id
            ) doc11 ON doc11.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as data_transfer_scheme FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.data_transfer_scheme = files.id
            ) doc12 ON doc12.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as inbox FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.inbox = files.id
            ) doc13 ON doc13.id = regions.id
            LEFT JOIN (
                SELECT regions.id, files.file_name as outgoing FROM documents AS doc
                    RIGHT JOIN regions ON doc.region_id = regions.id
                    RIGHT JOIN files ON doc.outgoing = files.id
            ) doc14 ON doc14.id = regions.id
            WHERE regions.id IN (SELECT region_id FROM project_regions WHERE project_id = $id)");

        $projectRegions = DB::select($projectRegionsQuery);
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
            'vu220' => '220_vu'
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

    public function editData($projectId, $regionId)
    {
        $projectStatus = ProjectStatus::where([['project_id', '=', $projectId], ['region_id', '=', $regionId]])->first();
        $roadTypes = RoadType::all();

        return view('edit-data', [
            'projectStatus' => $projectStatus,
            'roadTypes' => $roadTypes,
            'projectId' => $projectId,
            'regionId' => $regionId
        ]);
    }

    public function createData(Request $request)
    {
        $class = $request->get('table');

        /** @var Model $object */
        $object = $class::where([['project_id', '=', $request->get('project_id')], ['region_id', '=', $request->get('region_id')]])->first();
        if (!isset($object)) {
            $object = new $class;
        }

        $arRequest = $request->all();
        unset($arRequest['_token']);
        unset($arRequest['table']);

        $object->setRawAttributes($arRequest);
        $object->save();
        return redirect('/progress/' . $request->get('project_id'));
    }

    public function editInitialData($projectId, $regionId)
    {
        $initialData = InitialData::where([['project_id', '=', $projectId], ['region_id', '=', $regionId]])->first();
        $roadTypes = RoadType::all();
        $products = Product::all();

        return view('edit-initial-data', [
            'initialData' => $initialData,
            'roadTypes' => $roadTypes,
            'products' => $products,
            'projectId' => $projectId,
            'regionId' => $regionId
        ]);
    }

    public function editPir($projectId, $regionId)
    {
        $pir = Pir::where([['project_id', '=', $projectId], ['region_id', '=', $regionId]])->first();
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
            'projectId' => $projectId,
            'regionId' => $regionId
        ]);
    }

    public function editProduction($projectId, $regionId)
    {
        $production = Production::where([['project_id', '=', $projectId], ['region_id', '=', $regionId]])->first();
        $shipmentStatuses = ShipmentStatus::all();

        return view('edit-production', [
            'projectId' => $projectId,
            'regionId' => $regionId,
            'production' => $production,
            'shipmentStatuses' => $shipmentStatuses
        ]);
    }

    public function editSmr($projectId, $regionId)
    {
        $smr = SmrInstallation::where([['project_id', '=', $projectId], ['region_id', '=', $regionId]])->first();
        $vu220 = Vu220::all();
        $linkContract = LinkContract::all();
        $dislocationStrapping = DislocationStrapping::all();
        $installationStatus = InstallationStatus::all();
        $transferredPnr = TransferredPnr::all();

        return view('edit-smr', [
            'projectId' => $projectId,
            'regionId' => $regionId,
            'smr' => $smr,
            'vu220' => $vu220,
            'linkContract' => $linkContract,
            'dislocationStrapping' => $dislocationStrapping,
            'installationStatus' => $installationStatus,
            'transferredPnr' => $transferredPnr,
            'vuTable' => '220_vu'
        ]);
    }

    public function editPnr($projectId, $regionId)
    {
        $pnr = Pnr::where([['project_id', '=', $projectId], ['region_id', '=', $regionId]])->first();
        $calibration2000 = Calibration2000::all();
        $kps = Kp::all();
        $analysisResult = AnalysisResult::all();
        $complexToMonitoring = ComplexToMonitoring::all();
        $andromedaUnloading = AndromedaUnloading::all();
        $inCafap = InCafap::all();

        return view('edit-pnr', [
            'projectId' => $projectId,
            'regionId' => $regionId,
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
        $documents = Document::where([['project_id', '=', $request->get('project_id')], ['region_id', '=', $request->get('region_id')]])->first();
        $project = Project::find($request->get('project_id'));
        if (!isset($documents)) {
            $documents = new Document();
        }

        $documents->project_id = $request->get('project_id');
        $documents->region_id = $request->get('region_id');
        $documents->updateRecord($request, $project);
        return redirect('/progress/' . $project->id);
    }

    public function editDocuments($projectId, $regionId)
    {
        $documents = Document::where([['project_id', '=', $projectId], ['region_id', '=', $regionId]])->first();

        return view('edit-documents', [
            'documents' => $documents,
            'projectId' => $projectId,
            'regionId' => $regionId
        ]);
    }
}
