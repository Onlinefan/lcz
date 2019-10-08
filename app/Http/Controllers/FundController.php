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
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPExcel_IOFactory;

class FundController extends Controller
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
                }
            }
            return $next($request);
        });
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
        if (auth()->user()->role === 'Оператор') {
            $project = Project::find($request->get('project_id'));
            if ((int)auth()->user()->id !== (int)$project->head_id) {
                return redirect('/funds');
            }
        }

        $incomePlan = new IncomePlan($request->all());
        $incomePlan->save();
        return redirect('/funds');
    }

    public function addIncomePlan()
    {
        if (auth()->user()->role === 'Оператор') {
            $projects = Project::where(['head_id' => auth()->user()->id])->get();
        } else {
            $projects = Project::all();
        }
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
            return redirect('/funds');
        }

        $costPlan = new CostPlan($request->all());
        $costPlan->save();
        return redirect('/funds');
    }

    public function addOtherContract()
    {
        if (auth()->user()->role === 'Оператор') {
            $projects = Project::where(['head_id' => auth()->user()->id])->get();
        } else {
            $projects = Project::all();
        }

        return view('add-other-document', [
            'projects' => $projects
        ]);
    }

    public function createOtherContract(Request $request)
    {
        $otherContract = new OtherContract($request->all());
        $project = Project::find($request->get('project_id'));
        if (auth()->user()->role === 'Оператор') {
            if ((int)$project->head_id !== (int)auth()->user()->id) {
                return redirect('/funds');
            }
        }

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
        if (auth()->user()->role === 'Оператор') {
            $projectIds = Project::where(['head_id' => auth()->user()->id])->pluck('id')->all();
            $incomePlans = IncomePlan::whereIn('project_id', $projectIds)->get();
        } else {
            $incomePlans = IncomePlan::all();
        }

        return view('add-income', [
            'incomePlans' => $incomePlans
        ]);
    }

    public function createIncome(Request $request)
    {
        $income = new Income($request->all());
        $incomePlan = IncomePlan::find($request->get('plan_id'));
        $project = $incomePlan->project;
        if (auth()->user()->role === 'Оператор' && (int)$project->head_id !== (int)auth()->user()->id) {
            return redirect('/funds');
        }

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
        if (auth()->user()->role === 'Оператор') {
            $projectIds = Project::where(['head_id' => auth()->user()->id])->pluck('id')->all();
            $costPlans = CostPlan::whereIn('project_id', $projectIds)->get();
        } else {
            $costPlans = CostPlan::all();
        }

        return view('add-cost', [
            'costPlans' => $costPlans
        ]);
    }

    public function createCost(Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            $costPlan = CostPlan::find($request->get('plan_id'));
            if ((int)$costPlan->project->head_id !== (int)auth()->user()->id) {
                return redirect('/funds');
            }
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
        if (auth()->user()->role === 'Оператор') {
            return redirect('/funds');
        }

        $projects = Project::all();
        return view('add-cost-file', [
            'projects' => $projects
        ]);
    }

    public function createCostFile(Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/funds');
        }

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

    public function editIncomePlan($id)
    {
        $incomePlan = IncomePlan::find($id);
        if (auth()->user()->role === 'Оператор' && (int)$incomePlan->project->head_id !== (int)auth()->user()->id) {
            return redirect('/funds');
        }

        $projects = Project::all();
        return view('edit-income-plan', [
            'incomePlan' => $incomePlan,
            'projects' => $projects
        ]);
    }

    public function submitIncomePlan(Request $request)
    {
        $incomePlan = IncomePlan::find($request->get('id'));
        if (auth()->user()->role === 'Оператор' && (int)$incomePlan->project->head_id !== (int)auth()->user()->id) {
            return redirect('/funds');
        }

        $incomePlan->income_date = $request->get('income_date');
        $incomePlan->name = $request->get('name');
        $incomePlan->plan = $request->get('plan');
        $incomePlan->project_id = $request->get('project_id');
        $incomePlan->save();
        return redirect('/funds');
    }

    public function deleteIncomePlan($id)
    {
        $incomePlan = IncomePlan::find($id);
        if (auth()->user()->role === 'Оператор' && (int)$incomePlan->project->head_id !== (int)auth()->user()->id) {
            return redirect('/funds');
        }

        IncomePlan::destroy($id);
        $incomes = Income::where(['plan_id' => $id])->get();
        foreach ($incomes as $income) {
            $fileSystem = new Filesystem();
            if ($income->documentFile) {
                $file = File::find($income->document);
                $fileSystem->delete(public_path('Projects_files/' . $income->plan->project->code . '/Управление проектом/Договоры (поступления)/' . $income->plan->name . '/' . $file->file_name));
                $file->delete();
            }

            if ($income->closedDocumentFile) {
                $file = File::find($income->closed_document);
                $fileSystem->delete(public_path('Projects_files/' . $income->plan->project->code . '/Управление проектом/Договоры (поступления)/' . $income->plan->name . '/' . $file->file_name));
                $file->delete();
            }
        }

        return redirect('/funds');
    }

    public function editIncome($id)
    {
        $income = Income::find($id);
        if ((int)$income->plan->project->head_id && (int)auth()->user()->id) {
            return redirect('/funds');
        }


        $incomePlans = IncomePlan::all();
        return view('edit-income', [
            'income' => $income,
            'incomePlans' => $incomePlans
        ]);
    }

    public function submitIncome(Request $request)
    {
        $income = Income::find($request->get('id'));
        if ((int)$income->plan->project->head_id && (int)auth()->user()->id) {
            return redirect('/funds');
        }

        $income->plan_id = $request->get('plan_id');
        $income->count = $request->get('count');
        $income->date_payment = $request->get('date_payment');
        $income->payment_status = $request->get('payment_status');
        $income->document_number = $request->get('document_number');
        $income->date_document = $request->get('date_document');

        $fileSystem = new Filesystem();
        if ($request->file('document')) {
            if ($income->documentFile) {
                $file = File::find($income->document);
                $fileSystem->delete(public_path('Projects_files/' . $income->plan->project->code . '/Управление проектом/Договоры (поступления)/' . $income->plan->name . '/' . $file->file_name));
                $file->delete();
            }

            $file = new File();
            $fileName = File::createName($income->plan->project->name);
            $file->createFile($request->file('document'),
                public_path('Projects_files/' . $income->plan->project->code . '/Управление проектом/Договоры (поступления)/' . $income->plan->name . '/'),
                $fileName);
            $income->document = $file->id;
        }

        if ($request->file('closed_document')) {
            if ($income->closedDocumentFile) {
                $file = File::find($income->closed_document);
                $fileSystem->delete(public_path('Projects_files/' . $income->plan->project->code . '/Управление проектом/Договоры (поступления)/' . $income->plan->name . '/' . $file->file_name));
                $file->delete();
            }

            $file = new File();
            $fileName = File::createName($income->plan->project->name);
            $file->createFile($request->file('document'),
                public_path('Projects_files/' . $income->plan->project->code . '/Управление проектом/Договоры (поступления)/' . $income->plan->name . '/'),
                $fileName);
            $income->closed_document = $file->id;
        }

        $income->save();
        return redirect('/funds');
    }

    public function deleteIncome($id)
    {
        $income = Income::find($id);
        if ((int)$income->plan->project->head_id && (int)auth()->user()->id) {
            return redirect('/funds');
        }

        $fileSystem = new Filesystem();
        if ($income->documentFile) {
            $file = File::find($income->document);
            $fileSystem->delete(public_path('Projects_files/' . $income->plan->project->code . '/Управление проектом/Договоры (поступления)/' . $income->plan->name . '/' . $file->file_name));
            $file->delete();
        }

        if ($income->closedDocumentFile) {
            $file = File::find($income->closed_document);
            $fileSystem->delete(public_path('Projects_files/' . $income->plan->project->code . '/Управление проектом/Договоры (поступления)/' . $income->plan->name . '/' . $file->file_name));
            $file->delete();
        }

        $income->delete();
        return redirect('/funds');
    }

    public function editCostPlan($id)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/funds');
        }

        $costPlan = CostPlan::find($id);
        $projects = Project::all();
        return view('edit-cost-plan', [
            'costPlan' => $costPlan,
            'projects' => $projects
        ]);
    }

    public function submitCostPlan(Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/funds');
        }

        $costPlan = CostPlan::find($request->get('id'));
        $costPlan->plan = $request->get('plan');
        $costPlan->article = $request->get('article');
        $costPlan->project_id = $request->get('project_id');
        $costPlan->save();
        return redirect('/funds');
    }

    public function deleteCostPlan($id)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/funds');
        }

        CostPlan::destroy($id);
        Cost::where(['plan_id' => $id])->delete();
        return redirect('/funds');
    }

    public function editCost($id)
    {
        $cost = Cost::find($id);
        if (auth()->user()->role === 'Оператор' && (int)$cost->plan->project->head_id !== (int)auth()->user()->id) {
            return redirect('/funds');
        }

        if (auth()->user()->role === 'Оператор') {
            $projectIds = Project::where(['head_id' => auth()->user()->id])->pluck('id')->all();
            $costPlans = CostPlan::whereIn('project_id', $projectIds)->get();
        } else {
            $costPlans = CostPlan::all();
        }

        return view('edit-cost', [
            'cost' => $cost,
            'costPlans' => $costPlans
        ]);
    }

    public function submitCost(Request $request)
    {
        $cost = Cost::find($request->get('id'));
        if ((int)$cost->plan->project->head_id !== (int)auth()->user()->id) {
            return redirect('/funds');
        }

        $cost->count = $request->get('count');
        $cost->plan_id = $request->get('plan_id');
        $cost->date_payment = $request->get('date_payment');
        $cost->payment_method = $request->get('payment_method');
        $cost->comment = $request->get('comment');
        $cost->save();

        return redirect('/funds');
    }

    public function deleteCost($id)
    {
        $cost = Cost::find($id);
        if ((int)$cost->plan->project->head_id !== (int)auth()->user()->id) {
            return redirect('/funds');
        }

        Cost::destroy($id);
        return redirect('/funds');
    }

    public function editOtherDocument($id)
    {
        $document = OtherContract::find($id);
        if ((int)$document->project->head_id !== (int)auth()->user()->id) {
            return redirect('/funds');
        }

        if (auth()->user()->role === 'Оператор') {
            $projects = Project::where(['head_id' => auth()->user()->id]);
        } else {
            $projects = Project::all();
        }

        return view('edit-other-document', [
            'document' => $document,
            'projects' => $projects
        ]);
    }

    public function submitOtherDocument(Request $request)
    {
        $document = OtherContract::find($request->get('id'));
        if ((int)$document->project->head_id !== (int)auth()->user()->id) {
            return redirect('/funds');
        }

        $document->date_contract = $request->get('date_contract');
        $document->type = $request->get('type');
        $document->number = $request->get('number');
        $document->base = $request->get('base');
        $document->contractor = $request->get('contractor');
        $document->project_id = $request->get('project_id');

        if ($request->file('contract')) {
            if (isset($document->contractFile)) {
                $fileSystem = new Filesystem();
                $file = File::find($document->contract);
                $fileSystem->delete(public_path('Projects_files/' . $document->project->code . '/Договоры (иные)/' . $request->get('base') . '/' . $request->get('number') . ' ' . $request->get('contractor') . '/' . $file->file_name));
                $file->delete();
            }

            $file = new File();
            $fileName = File::createName($document->project->name);
            $file->createFile($request->file('contract'),
                public_path('Projects_files/' . $document->project->code . '/Договоры (иные)/' . $request->get('base') . '/' . $request->get('number') . ' ' . $request->get('contractor') . '/'),
                $fileName);
            $document->contract = $file->id;
        }

        $document->save();
        return redirect('/funds');
    }

    public function deleteOtherDocument($id)
    {
        $document = OtherContract::find($id);
        if ((int)$document->project->head_id !== (int)auth()->user()->id) {
            return redirect('/funds');
        }

        if (isset($document->contractFile)) {
            $fileSystem = new Filesystem();
            $file = File::find($document->contract);
            $fileSystem->delete(public_path('Projects_files/' . $document->project->code . '/Договоры (иные)/' . $document->base . '/' . $document->number . ' ' . $document->contractor . '/' . $file->file_name));
            $file->delete();
        }

        $document->delete();
        return redirect('/funds');
    }
}
