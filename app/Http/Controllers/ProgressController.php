<?php

namespace App\Http\Controllers;

use App\Document;
use App\InitialData;
use App\Pir;
use App\Pnr;
use App\Product;
use App\Production;
use App\Progress;
use App\Project;
use App\ProjectRegion;
use App\ProjectStatus;
use App\RoadType;
use App\SmrInstallation;
use DateTime;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = 34)
    {
        $project = Project::find($id);
        $projectStatus = ProjectStatus::where(['project_id' => $id])->get();
        $initialData = InitialData::where(['project_id' => $id])->get();
        $pir = Pir::where(['project_id' => $id])->get();
        $production = Production::where(['project_id' => $id])->get();
        $smrInstallation = SmrInstallation::where(['project_id' => $id])->get();
        $pnr = Pnr::where(['project_id' => $id])->get();
        $documents = Document::where(['project_id' => $id])->get();
        $now = new DateTime('now');
        $contractEnd = new DateTime($project->contract->date_end);
        $contractStart = new DateTime($project->contract->date_start);
        $dateDiff = $contractEnd->diff($now)->format('%a');
        $datePercent = $now->diff($contractStart)->format('%a')/$contractEnd->diff($contractStart)->format('%a')*100;
        $projectRegions = ProjectRegion::where(['project_id' => $id])->get();
        $products = Product::all();
        $roadTypes = RoadType::all();
        return view('progress', [
            'project' => $project,
            'projectStatus' => $projectStatus,
            'initialData' => $initialData,
            'pir' => $pir,
            'production' => $production,
            'smrInstallation' => $smrInstallation,
            'pnr' => $pnr,
            'documents' => $documents,
            'dateDiff' => $dateDiff,
            'datePercent' =>$datePercent,
            'projectRegions' => $projectRegions,
            'product' => $products,
            'roadTypes' => $roadTypes
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
}
