<?php

namespace App\Http\Controllers;

use App\Cafap;
use App\CafapAndromedaExist;
use App\CafapCollage;
use App\CafapRegion;
use App\Contact;
use App\Contract;
use App\Country;
use App\Product;
use App\ProductionPlan;
use App\Project;
use App\ProjectContact;
use App\ProjectCountry;
use App\ProjectProductCount;
use App\ProjectRegion;
use App\ProjectResponsibilityArea;
use App\ProjectRoad;
use App\ProjectServiceType;
use App\ProjectStatus;
use App\Region;
use App\RoadType;
use App\ServiceType;
use App\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectRealization = Project::where(['status' => 'Реализация'])->orWhere(['status' => 'Приостановлено'])->get();
        $projectExploitation = Project::where(['status' => 'Эксплуатация'])->get();
        $projectFinished = Project::where(['status' => 'Завершен'])->get();
        return view('projects', [
            'realization' => $projectRealization,
            'exploitation' => $projectExploitation,
            'finished' => $projectFinished
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role === 'Оператор') {
            $users = User::where(['id' => auth()->user()->id])->get();
        } else {
            $users = User::all();
        }

        $roadTypes = RoadType::all();
        $products = Product::all();
        $regions = Region::all();
        $countries = Country::all();
        $serviceTypes = ServiceType::all();

        return view('create-project', [
            'users' => $users,
            'roadTypes' => $roadTypes,
            'products' => $products,
            'regions' => $regions,
            'countries' => $countries,
            'serviceTypes' => $serviceTypes
        ]);
    }

    public function add(Request $request)
    {
        $project = new Project($request->get('Project'));
        $project->createRecord();
        $contract = new Contract($request->get('Contract'));
        $contract->createRecord($request->file('Contract'), $project);

        ProjectCountry::createRecords($request->get('Country'), $project->id);
        ProjectRegion::createRecords($request->get('Region'), $project->id);
        ProjectServiceType::createRecords($request->get('ProjectServiceTypes'), $project->id);
        ProjectRoad::createRecords($request->get('ProjectRoad'), $project->id);
        ProjectProductCount::createRecords($request->get('ProjectProduct'), $project->id);
        ProjectResponsibilityArea::createRecord($request->get('ProjectResponsibility'), $project->id);

        $cafap = new Cafap();
        $cafap->createRecord($request->file('Cafap'), $project);

        CafapCollage::createRecords($request->file('CafapCollage'), $cafap->id, $project);
        CafapRegion::createRecords($request->get('CafapRegion'), $cafap->id);
        CafapAndromedaExist::createRecords($request->get('CafapAndromedaExist'), $cafap->id);
        ProductionPlan::createRecords($request->get('ProductionPlan'), $request->file('ProductionPlan'), $project);
        ProjectContact::createRecords($request->get('Contacts'), $project->id);

        return redirect('/create-project');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Project::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return $project;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        if (auth()->user()->role === 'Оператор') {
            $users = User::where('id', auth()->user()->id)->get();
        } else {
            $users = User::all();
        }

        $roadTypes = RoadType::all();
        $products = Product::all();
        $regions = Region::all();
        $countries = Country::all();
        $serviceTypes = ServiceType::all();
        $projectCountries = ProjectCountry::where(['project_id' => $id])->get();
        $projectRegions = ProjectRegion::where(['project_id' => $id])->get();
        $projectServiceTypes = ProjectServiceType::where(['project_id' => $id])->get();
        $projectRoads = ProjectRoad::where(['project_id' => $id])->get();
        $projectProducts = ProjectProductCount::where(['project_id' => $id])->get();

        return view('edit-project', [
            'users' => $users,
            'roadTypes' => $roadTypes,
            'products' => $products,
            'regions' => $regions,
            'countries' => $countries,
            'serviceTypes' => $serviceTypes,
            'project' => $project,
            'projectCountries' => $projectCountries,
            'projectRegions' => $projectRegions,
            'projectServiceTypes' => $projectServiceTypes,
            'projectRoads' => $projectRoads,
            'projectProducts' => $projectProducts
        ]);
    }

    public function editProject(Request $request)
    {
        $projectRequest = $request->get('Project');
        $project = Project::find($projectRequest['id']);
        $project->status = $projectRequest['status'];
        $project->head_id = $projectRequest['head_id'];
        $project->name = $projectRequest['name'];
        $project->type = $projectRequest['type'];
        $project->save();

        /** @var Contract $contract */
        $contract = $project->contract;
        $contract->setRawAttributes($request->get('Contract'));
        $contract->updateRecord($request->file('Contract'), $project);

        ProjectCountry::updateRecords($request->get('Country'), $project->id);
        ProjectRegion::updateRecords($request->get('Region'), $project->id);
        ProjectServiceType::updateRecords($request->get('ProjectServiceTypes'), $project->id);
        ProjectRoad::updateRecords($request->get('ProjectRoad'), $project->id);
        ProjectProductCount::updateRecords($request->get('ProjectProduct'), $project->id);
        ProjectResponsibilityArea::updateRecord($request->get('ProjectResponsibility'), $project->id);

        $cafap = Cafap::where(['project_id' => $project->id])->first();
        $cafap->updateRecord($request->file('Cafap'), $project);

        CafapCollage::updateRecords($request->file('CafapCollage'), $cafap->id, $project);
        CafapRegion::updateRecords($request->get('CafapRegion'), $cafap->id);
        CafapAndromedaExist::updateRecords($request->get('CafapAndromedaExist'), $cafap->id);
        ProductionPlan::updateRecords($request->get('ProductionPlan'), $request->file('ProductionPlan'), $project);
        ProjectContact::updateRecords($request->get('Contacts'), $project->id);
        return redirect('/edit-project/' . $project->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        if($project->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->delete()){
            return true;
        }
    }
}
