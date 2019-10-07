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
use PHPExcel_IOFactory;

class FundController extends Controller
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
    public function index(Request $request)
    {
        $requestIncome = $request->get('IncomePlan');
        $requestCost = $request->get('CostPlan');
        if ($requestIncome) {
            $incomeObj = new IncomePlan;
            $incomePlans = $incomeObj->findPlan($requestIncome, auth()->user()->role);
            $projectIds = Project::where(['head_id' => auth()->user()->id])->pluck('id')->all();
            $costPlans = auth()->user()->role === 'Оператор' ? CostPlan::whereIn('project_id', $projectIds)->get() : CostPlan::all();
            $otherDocuments = auth()->user()->role === 'Оператор' ? CostPlan::whereIn('project_id', $projectIds)->get() : OtherContract::all();
        } elseif ($requestCost) {
            $costObj = new CostPlan;
            $costPlans = $costObj->findPlan($requestCost, auth()->user()->role);
            $projectIds = Project::where(['head_id' => auth()->user()->id])->pluck('id')->all();
            $incomePlans = auth()->user()->role === 'Оператор' ? IncomePlan::whereIn('project_id', $projectIds)->get() : IncomePlan::all();
            $otherDocuments = auth()->user()->role === 'Оператор' ? OtherContract::whereIn('project_id', $projectIds)->get() : OtherContract::all();
        } else {
            $projectIds = Project::where(['head_id' => auth()->user()->id])->pluck('id')->all();
            $incomePlans = auth()->user()->role === 'Оператор' ? IncomePlan::whereIn('project_id', $projectIds)->get() : IncomePlan::all();
            $costPlans = auth()->user()->role === 'Оператор' ? CostPlan::whereIn('project_id', $projectIds)->get() : CostPlan::all();
            $otherDocuments = auth()->user()->role === 'Оператор' ? OtherContract::whereIn('project_id', $projectIds)->get() : OtherContract::all();
        }

        return view('funds', [
            'incomePlans' => $incomePlans,
            'costPlans' => $costPlans,
            'otherDocuments' => $otherDocuments,
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
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $projects = Project::all();
        return view('add-cost-plan', [
            'projects' => $projects
        ]);
    }

    public function createCostPlan(Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

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
            public_path('Projects_files/' . $project->code . '/Договоры (иные)/' . $request->get('base') . '/' . $request->get('number') . ' ' . $request->get('contractor') . '/'),
            $fileName);
        $otherContract->contract = $file->id;
        $otherContract->save();
        return redirect('/funds');
    }

    public function addIncome()
    {
        $incomePlans = IncomePlan::all();
        return view('add-income', [
            'incomePlans' => $incomePlans
        ]);
    }

    public function createIncome(Request $request)
    {
        $income = new Income($request->all());
        $incomePlan = IncomePlan::find($request->get('plan_id'));
        $project = $incomePlan->project;
        if ($request->file('document')) {
            $file = new File();
            $fileName = File::createName($project->name);
            $file->createFile($request->file('document'),
                public_path('Projects_files/' . $project->code . '/Управление проектом/Договоры (поступления)/' . $incomePlan->name . '/'),
                $fileName);
            $income->document = $file->id;
        }

        if ($request->file('closed_document')) {
            $file = new File();
            $fileName = File::createName($project->name);
            $file->createFile($request->file('closed_document'),
                public_path('Projects_files/' . $project->code . '/Управление проектом/Договоры (поступления)/' . $incomePlan->name . '/'),
                $fileName);
            $income->closed_document = $file->id;
        }
        $income->save();
        return redirect('/funds');
    }

    public function addCost()
    {
        $costPlans = CostPlan::all();
        return view('add-cost', [
            'costPlans' => $costPlans
        ]);
    }

    public function createCost(Request $request)
    {
        $cost = new Cost($request->all());
        $cost->save();
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

    public function addCostFile()
    {
        $projects = Project::all();
        return view('add-cost-file', [
            'projects' => $projects
        ]);
    }

    public function createCostFile(Request $request)
    {
        require_once public_path('Classes/PHPExcel.php');

        $fileType = PHPExcel_IOFactory::identify($request->file('file')->path());

        $objReader = PHPExcel_IOFactory::createReader($fileType);
        $objPhpExcel = $objReader->load($request->file('file')->path());
        $result = $objPhpExcel->getActiveSheet()->toArray();
        foreach ($result as $row) {
            $costPlan = new CostPlan(['plan' => $row[0], 'article' => $row[1], 'project_id' => $request->get('project_id')]);
            $costPlan->save();
        }

        return redirect('/funds');
    }
}
