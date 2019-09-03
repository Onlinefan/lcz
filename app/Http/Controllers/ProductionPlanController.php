<?php

namespace App\Http\Controllers;

use App\Product;
use App\Production;
use App\ProductionPlan;
use App\Project;
use App\Region;
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
        $projects = Project::all();
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
            $productionPlan = new ProductionPlan();
            $productionPlan->project_id = $request['project_id'];
            $productionPlan->month = $request['month'];
            $productionPlan->region_id = $request['region_id'];
            $productionPlan->product_id = $request['product_id'];
            $productionPlan->rk_count = $request['rk_count'];
            $productionPlan->date_shipping = date('Y-m-d', strtotime($request['date_shipping']));
            $productionPlan->priority = $request['priority'];
            $productionPlan->save();
        }
        return redirect('/production_plan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Production::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function show(Production $production)
    {
        return $production;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function edit(Production $production)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Production $production)
    {
        if($production->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Production  $production
     * @return \Illuminate\Http\Response
     */
    public function destroy(Production $production)
    {
        if($production->delete()){
            return true;
        }
    }
}
