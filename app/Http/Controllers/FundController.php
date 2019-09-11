<?php

namespace App\Http\Controllers;

use App\Cost;
use App\CostPlan;
use App\File;
use App\Fund;
use App\Income;
use App\IncomePlan;
use App\OtherContract;
use App\PaymentDocumentType;
use App\Project;
use Illuminate\Http\Request;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incomePlans = IncomePlan::all();
        $costPlans = CostPlan::all();
        $otherDocuments = OtherContract::all();
        $incomes = Income::all();
        $costs = Cost::all();
        return view('funds', [
            'incomePlans' => $incomePlans,
            'costPlans' => $costPlans,
            'otherDocuments' => $otherDocuments,
            'incomes' => $incomes,
            'costs' => $costs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createIncomePlan(Request $request)
    {
        $incomePlan = new IncomePlan($request->all());
        $incomePlan->save();
        return redirect('/funds');
    }

    public function addIncomePlan()
    {
        $projects = Project::all();
        return view('add-income-plan', [
            'projects' => $projects
        ]);
    }

    public function addCostPlan()
    {
        $projects = Project::all();
        return view('add-cost-plan', [
            'projects' => $projects
        ]);
    }

    public function createCostPlan(Request $request)
    {
        $costPlan = new CostPlan($request->all());
        $costPlan->save();
        return redirect('/funds');
    }

    public function addOtherContract()
    {
        $projects = Project::all();
        return view('add-other-document', [
            'projects' => $projects
        ]);
    }

    public function createOtherContract(Request $request)
    {
        $otherContract = new OtherContract($request->all());
        $project = Project::find($request->get('project_id'));
        $file = new File();
        $fileName = File::createName($project->name);
        $file->createFile($request->file('contract'),
            public_path('Проекты/' . $project->code . '/Договоры (иные)/' . $request->get('base') . '/' . $request->get('number') . ' ' . $request->get('contractor') . '/'),
            $fileName);
        $otherContract->contract = $file->id;
        $otherContract->save();
        return redirect('/funds');
    }

    public function addIncome()
    {
        $documentTypes = PaymentDocumentType::all();
        $incomePlans = IncomePlan::all();
        return view('add-income', [
            'documentTypes' => $documentTypes,
            'incomePlans' => $incomePlans
        ]);
    }

    public function createIncome(Request $request)
    {
        $income = new Income($request->all());
        $incomePlan = IncomePlan::find($request->get('plan_id'));
        $incomePlan->payed = floatval($incomePlan->payed) + floatval($request->get('count'));
        $project = $incomePlan->project;
        $file = new File();
        $fileName = File::createName($project->name);
        $file->createFile($request->file('document'),
            public_path('Проекты/' . $project->code . '/Управление проектом/Договоры (поступления)/' . $request->get('payment_document') . '/'),
            $fileName);
        $income->document = $file->id;
        $income->save();
        $incomePlan->save();
        return redirect('/funds');
    }

    public function addCost()
    {
        $documentTypes = PaymentDocumentType::all();
        $costPlans = CostPlan::all();
        return view('add-cost', [
            'documentTypes' => $documentTypes,
            'costPlans' => $costPlans
        ]);
    }

    public function createCost(Request $request)
    {
        $cost = new Cost($request->all());
        $costPlan = CostPlan::find($request->get('plan_id'));
        $costPlan->count = floatval($costPlan->count) + floatval($request->get('count'));
        $project = $costPlan->project;
        $file = new File();
        $fileName = File::createName($project->name);
        $file->createFile($request->file('document'),
            public_path('Проекты/' . $project->code . '/Управление проектом/Договоры (затраты)/' . $request->get('payment_document') . '/'),
            $fileName);
        $cost->document = $file->id;
        $cost->save();
        $costPlan->save();
        return redirect('/funds');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Fund::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fund  $funds
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $funds)
    {
        return $funds;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function edit(Fund $fund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fund $fund)
    {
        if($fund->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fund $fund)
    {
        if($fund->delete()){
            return true;
        }
    }
}
