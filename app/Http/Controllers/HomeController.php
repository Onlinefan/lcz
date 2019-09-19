<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role !== 'Оператор') {
            $contracts = DB::table('contracts')
                ->select(DB::raw('sum(amount) as contract_sum, count(*) as contract_count'))
                ->get();
            $signPercent = DB::table('contracts')
                ->select(DB::raw('count(*) as count'))
                ->where('sign_status', '=', 'Подписан с обеих сторон')
                ->get();
            $incomes = DB::table('income')
                ->select(DB::raw('sum(count) as income_sum, count(*) as income_count'))
                ->get();
            $projectTypes = DB::table('projects')
                ->select(DB::raw('type, count(*) as type_count'))
                ->where('status', '=', 'Реализация')
                ->groupBy(['type'])
                ->get();
            $projectStatuses = DB::table('projects')
                ->select(DB::raw('status, count(*) as status_count'))
                ->groupBy(['status'])
                ->get();
            $projectCountries = DB::table('projects')
                ->join('project_regions', 'projects.id', '=', 'project_regions.project_id')
                ->join('contracts', 'projects.id', '=', 'contracts.project_id')
                ->join('countries', 'project_regions.country_id', '=', 'countries.id')
                ->select(DB::raw('countries.name, count(*) as region_count, sum(contracts.amount) as contracts_sum'))
                ->groupBy(['countries.name'])
                ->get();
            $regionRk = DB::table('projects')
                ->join('project_regions', 'projects.id', '=', 'project_regions.project_id')
                ->join('regions', 'project_regions.region_id', '=', 'regions.id')
                ->join('project_products_count', 'projects.id', '=', 'project_products_count.project_id')
                ->join('products', 'project_products_count.product_id', '=', 'products.id')
                ->join('contracts', 'projects.id', '=', 'contracts.project_id')
                ->select(DB::raw('regions.name, products.name, sum(project_products_count.count) as sum_count, sum(contracts.amount) as sum_contracts'))
                ->groupBy(['regions.name', 'products.name'])
                ->get();

            return view('home', [
                'contracts' => $contracts[0],
                'incomes' => $incomes[0],
                'projectTypes' => $projectTypes,
                'projectStatuses' => $projectStatuses,
                'projectCountries' => $projectCountries,
                'regionRk' => $regionRk,
                'signPercent' => $signPercent[0]
            ]);
        }
        return redirect('/projects');

    }
}
