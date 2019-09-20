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
            $contractCount = DB::table('projects')
                ->select(DB::raw('count(*) as count'))
                ->where('type', 'Гос. контракт')
                ->first();
            $pilotCount = DB::table('projects')
                ->select(DB::raw('count(*) as count'))
                ->where('type', 'Пилот')
                ->first();
            $exploitationCount = DB::table('projects')
                ->select(DB::raw('count(*) as count'))
                ->where('status', 'Эксплуатация')
                ->first();
            $finishCount = DB::table('projects')
                ->select(DB::raw('count(*) as count'))
                ->where('status', 'Завершен')
                ->first();
            $garantCount = DB::table('contracts')
                ->select(DB::raw('count(*) as count'))
                ->where('service_terms', 'Гарантийное')
                ->first();
            $rentCount = DB::table('contracts')
                ->select(DB::raw('count(*) as count'))
                ->where('service_terms', 'Аренда')
                ->first();
            $techCount = DB::table('contracts')
                ->select(DB::raw('count(*) as count'))
                ->where('service_terms', 'Тех. обслуживание')
                ->first();

            $regionsTable = DB::select(DB::raw('SELECT `c`.name, pc1.amount, pr1.regions_count FROM countries AS `c`
	LEFT JOIN (
		SELECT `c`.id, SUM(DISTINCT contracts.amount) AS amount
			FROM `project_countries` AS `pc`
				RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
				RIGHT JOIN contracts ON `p`.id = contracts.project_id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				GROUP BY `pc`.country_id, `c`.id
		) pc1 ON pc1.id = `c`.id
	LEFT JOIN (
		SELECT `c`.id, COUNT(DISTINCT `pr`.region_id) AS regions_count
			FROM `project_regions` AS `pr`
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pr`.country_id
				GROUP BY `pr`.country_id, `c`.id
		) pr1 ON pr1.id = `c`.id'));
            return view('home', [
                'contracts' => $contracts[0],
                'incomes' => $incomes[0],
                'signPercent' => $signPercent[0],
                'contractCount' => $contractCount->count,
                'pilotCount' => $pilotCount->count,
                'exploitationCount' => $exploitationCount->count,
                'finishCount' => $finishCount->count,
                'garantCount' => $garantCount->count,
                'rentCount' => $rentCount->count,
                'techCount' => $techCount->count,
                'regionsTable' => $regionsTable
            ]);
        }
        return redirect('/home2');

    }
}
