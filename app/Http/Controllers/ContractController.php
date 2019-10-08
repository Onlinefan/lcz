<?php

namespace App\Http\Controllers;

use App\Contract;
use App\DocumentStatus;
use App\File;
use App\FinancialStatus;
use App\Project;
use App\ServiceStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
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
    public function index()
    {
        if (auth()->user()->role !== 'Оператор') {
            $projects = Project::all();
        } else {
            $projects = Project::where(['head_id' => auth()->user()->id])->get();
        }

        return view('contracts', [
            'projects' => $projects
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

    public function addDocumentStatus()
    {
        $projects = Project::all();
        return view('add-document-status', [
            'projects' => $projects
        ]);
    }

    public function createDocumentStatus(Request $request)
    {
        $documentStatus = new DocumentStatus($request->all());
        $project = Contract::find($request->get('contract_id'))->project;
        $file = new File();
        $fileName = File::createName($project->name);
        $file->createFile($request->file('scan_payment_document'),
            public_path('Projects_files/' . $project->code . '/Управление проектом/Статус выставленных документов/' . $request->get('payment_document') . '/'),
            $fileName);
        $documentStatus->scan_payment_document = $file->id;
        $documentStatus->save();
        return redirect('/contracts');
    }

    public function addServiceStatus()
    {
        $projects = Project::all();
        return view('add-service-status', [
            'projects' => $projects
        ]);
    }

    public function createServiceStatus(Request $request)
    {
        $serviceStatus = new ServiceStatus($request->all());
        $project = Contract::find($request->get('contract_id'))->project;
        $file = new File();
        $fileName = File::createName($project->name);
        $file->createFile($request->file('scan_payment_document'),
            public_path('Projects_files/' . $project->code . '/Управление проектом/Статус обслуживания/' . $request->get('payment_document') . '/'),
            $fileName);
        $serviceStatus->scan_payment_document = $file->id;
        $serviceStatus->save();
        return redirect('/contracts');
    }

    public function addFinancialStatus()
    {
        $projects = Project::all();
        return view('add-financial-status', [
            'projects' => $projects
        ]);
    }

    public function createFinancialStatus(Request $request)
    {
        $financialStatus = new FinancialStatus($request->all());
        $financialStatus->save();
        return redirect('/contracts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Contract::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract  $contracts
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contracts)
    {
        return $contracts;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        if($contract->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        if($contract->delete()){
            return true;
        }
    }
}
