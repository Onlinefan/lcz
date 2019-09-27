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
            if (auth()->user()->role === 'Оператор') {
                $projectIds = Project::where(['head_id' => auth()->user()->id])->pluck('id')->all();
                if ($requestIncome['name']) {
                    $incomePlans = IncomePlan::whereIn('project_id', $projectIds)->where('name', 'LIKE', "%{$requestIncome['name']}%")->get();
                } else {
                    $incomePlans = IncomePlan::whereIn('project_id', $projectIds)->get();
                }
                $costPlans = CostPlan::whereIn('project_id', $projectIds)->get();
                $otherDocuments = OtherContract::whereIn('project_id', $projectIds)->get();
            } else {
                if ($requestIncome['name']) {
                    $incomePlans = IncomePlan::where('name', 'like', "%{$requestIncome['name']}%")->get();
                } else {
                    $incomePlans = IncomePlan::all();
                }
                $costPlans = CostPlan::all();
                $otherDocuments = OtherContract::all();
            }
        } elseif ($requestCost) {
            if (auth()->user()->role === 'Оператор') {
                $projectIds = Project::where(['head_id' => auth()->user()->id])->pluck('id')->all();
                if ($requestCost['article']) {
                    $costPlans = CostPlan::whereIn('project_id', $projectIds)->where('article', 'like', "%{$requestCost['article']}%")->get();
                } else {
                    $costPlans = CostPlan::whereIn('project_id', $projectIds)->get();
                }
                $incomePlans = IncomePlan::whereIn('project_id', $projectIds)->get();
                $otherDocuments = OtherContract::whereIn('project_id', $projectIds)->get();
            } else {
                if ($requestCost['article']) {
                    $costPlans = CostPlan::where('article', 'like', "%{$requestCost['article']}%")->get();
                } else {
                    $costPlans = CostPlan::all();
                }
                $incomePlans = IncomePlan::all();
                $otherDocuments = OtherContract::all();
            }
        } else {
            if (auth()->user()->role === 'Оператор') {
                $projectIds = Project::where(['head_id' => auth()->user()->id])->pluck('id')->all();
                $incomePlans = IncomePlan::whereIn('project_id', $projectIds)->get();
                $costPlans = CostPlan::whereIn('project_id', $projectIds)->get();
                $otherDocuments = OtherContract::whereIn('project_id', $projectIds)->get();
            } else {
                $incomePlans = IncomePlan::all();
                $costPlans = CostPlan::all();
                $otherDocuments = OtherContract::all();
            }
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
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $incomePlan = new IncomePlan($request->all());
        $incomePlan->save();
        return redirect('/funds');
    }

    public function addIncomePlan()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

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
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $projects = Project::all();
        return view('add-other-document', [
            'projects' => $projects
        ]);
    }

    public function createOtherContract(Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $otherContract = new OtherContract($request->all());
        $project = Project::find($request->get('project_id'));
        $file = new File();
        $fileName = File::createName($project->name);
        $file->createFile($request->file('contract'),
            public_path('Projects_files/' . $project->code . '/Dogovory (inie)/' . $request->get('base') . '/' . $request->get('number') . ' ' . $request->get('contractor') . '/'),
            $fileName);
        $otherContract->contract = $file->id;
        $otherContract->save();
        return redirect('/funds');
    }

    public function addIncome()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $incomePlans = IncomePlan::all();
        return view('add-income', [
            'incomePlans' => $incomePlans
        ]);
    }

    public function createIncome(Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $income = new Income($request->all());
        $incomePlan = IncomePlan::find($request->get('plan_id'));
        $project = $incomePlan->project;
        if ($request->file('document')) {
            $file = new File();
            $fileName = File::createName($project->name);
            $file->createFile($request->file('document'),
                public_path('Projects_files/' . $project->code . '/Upravleniye proektom/Dogovory (postupleniya)/' . $incomePlan->name . '/'),
                $fileName);
            $income->document = $file->id;
        }

        if ($request->file('closed_document')) {
            $file = new File();
            $fileName = File::createName($project->name);
            $file->createFile($request->file('closed_document'),
                public_path('Projects_files/' . $project->code . '/Upravleniye proektom/Dogovory (postupleniya)/' . $incomePlan->name . '/'),
                $fileName);
            $income->closed_document = $file->id;
        }
        $income->save();
        return redirect('/funds');
    }

    public function addCost()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $costPlans = CostPlan::all();
        return view('add-cost', [
            'costPlans' => $costPlans
        ]);
    }

    public function createCost(Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

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
