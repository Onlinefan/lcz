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
        return view('projects');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        return view('edit-project', [
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

        return redirect('/edit-project');
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
    public function edit(Project $project)
    {
        //
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
