<?php

namespace App\Http\Controllers;

use App\File;
use App\Product;
use App\Production;
use App\ProductionPlan;
use App\Project;
use App\Region;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;

class ProductionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productionPlan = ProductionPlan::all();

        return view('production_plan', [
            'productionPlan' => $productionPlan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createView()
    {
        if (auth()->user()->role === 'Оператор') {
            $projects = Project::where(['head_id' => auth()->user()->id]);
        } else {
            $projects = Project::all();
        }

        $regions = Region::all();
        $products = Product::all();

        return view('add_production_plan', [
            'projects' => $projects,
            'regions' => $regions,
            'products' => $products
        ]);
    }

    public function create(Request $request)
    {
        if ($request->all()) {
            $productionPlan = new ProductionPlan($request->all());
            $project = Project::find($request->get('project_id'));
            if ($request->file('preliminary_calculation_equipment')) {
                $file = new File();
                $fileName = File::createName($project->name);
                $file->createFile($request->file('preliminary_calculation_equipment'),
                    public_path('/Projects_files/' . $project->code . '/Upravleniye proektom/Predvaritelnyi raschet oborudovaniya/'), $fileName);
                $productionPlan->preliminary_calculation_equipment = $file->id;
            }

            if ($request->file('final_calculation_equipment')) {
                $file = new File();
                $fileName = File::createName($project->name);
                $file->createFile($request->file('final_calculation_equipment'),
                    public_path('/Projects_files/' . $project->code . '/Upravleniye proektom/Okonchatelnyi raschet oborudovaniya/'), $fileName);
                $productionPlan->final_calculation_equipment = $file->id;
            }

            $productionPlan->save();
        }

        return redirect('/production_plan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Production::Create($request->all())) {
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Production $production
     * @return \Illuminate\Http\Response
     */
    public function show(Production $production)
    {
        return $production;
    }

    public function edit($id)
    {
        $productionPlan = ProductionPlan::find($id);
        if ((int)$productionPlan->project->head_id !== (int)auth()->user()->id && auth()->user()->role === 'Оператор') {
            return redirect('/production_plan');
        }

        $projects = Project::all();
        $regions = Region::all();
        $products = Product::all();

        return view('edit-production-plan', [
            'projects' => $projects,
            'regions' => $regions,
            'products' => $products,
            'productionPlan' => $productionPlan
        ]);
    }

    public function editSubmit(Request $request)
    {
        $productionPlan = ProductionPlan::find($request->get('id'));

        $productionPlan->project_id = $request->get('project_id');
        $productionPlan->rk_count = $request->get('rk_count') ?: $productionPlan->rk_count;
        $productionPlan->date_shipping = $request->get('date_shipping') ?: $productionPlan->date_shipping;
        $productionPlan->priority = $request->get('priority') ?: $productionPlan->priority;
        $productionPlan->month = $request->get('month') ?: $productionPlan->month;
        $productionPlan->region_id = $request->get('region_id') ?: $productionPlan->region_id;

        $project = Project::find($request->get('project_id'));
        $fileSystem = new Filesystem();
        if ($request->file('preliminary_calculation_equipment')) {
            if (isset($productionPlan->preliminaryCalculation)) {
                $file = File::find($productionPlan->preliminary_calculation_equipment);
                $fileSystem->delete(public_path('Projects_files/' . $project->code . '/Upravleniye proektom/Predvaritelnyi raschet oborudovaniya/' . $file->file_name));
                $file->delete();
            }

            $file = new File();
            $fileName = File::createName($project->name);
            $file->createFile($request->file('preliminary_calculation_equipment'),
                public_path('/Projects_files/' . $project->code . '/Upravleniye proektom/Predvaritelnyi raschet oborudovaniya/'), $fileName);
            $productionPlan->preliminary_calculation_equipment = $file->id;
        }

        if ($request->file('final_calculation_equipment')) {
            if (isset($productionPlan->final_calculation_equipment)) {
                $file = File::find($productionPlan->final_calculation_equipment);
                $fileSystem->delete(public_path('Projects_files/' . $project->code . '/Upravleniye proektom/Okonchatelnyi raschet oborudovaniya/' . $file->file_name));
                $file->delete();
            }

            $file = new File();
            $fileName = File::createName($project->name);
            $file->createFile($request->file('final_calculation_equipment'),
                public_path('/Projects_files/' . $project->code . '/Upravleniye proektom/Okonchatelnyi raschet oborudovaniya/'), $fileName);
            $productionPlan->final_calculation_equipment = $file->id;
        }

        $productionPlan->save();

        return redirect('/production_plan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Production $production
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Production $production)
    {
        if ($production->fill($request->all())->save()) {
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Production $production
     * @return \Illuminate\Http\Response
     */
    public function destroy(Production $production)
    {
        if ($production->delete()) {
            return true;
        }
    }
}
