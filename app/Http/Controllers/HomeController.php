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

            $query = DB::raw("SELECT `c`.name AS 'Округ/Страна', `linear_road`.linear_road as 'Лин. (тип 1)',
`crossroad`.crossroad as 'Пер. (тип 2)', `pedestrian`.pedestrian as 'Пер. (тип 3)', `product1`.kopp as 'Коперник (передвижка)', `product2`.kops AS 'Коперник (стационар)',
`product3`.arhimed AS 'Архимед', `product4`.andromeda as 'Андромеда', `pc1`.quantity as 'Количество', `pc2`.amount FROM `countries` as `c`
	LEFT JOIN (
		SELECT `c`.id, COUNT(`p`.status) AS quantity
			FROM `project_countries` AS `pc`
				RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				GROUP BY `pc`.country_id, `c`.id
		) pc1 ON pc1.id = `c`.id	
	left join (
		select `c`.id, sum(distinct `project_roads`.count) as linear_road
			from `project_countries` as `pc`
				right join `project_roads` on `pc`.project_id = `project_roads`.project_id
				right join `countries` as `c` on `c`.id = `pc`.country_id
				where `project_roads`.road_id = 1
				group by `pc`.country_id, `c`.id
		) `linear_road` on `linear_road`.id = `c`.id	
	LEFT JOIN (
		SELECT `c`.id, SUM(DISTINCT `project_roads`.count) AS crossroad
			FROM `project_countries` AS `pc`
				RIGHT JOIN `project_roads` ON `pc`.project_id = `project_roads`.project_id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				WHERE `project_roads`.road_id = 2
				GROUP BY `pc`.country_id, `c`.id
		) `crossroad` ON `crossroad`.id = `c`.id
	LEFT JOIN (
		SELECT `c`.id, SUM(DISTINCT `project_roads`.count) AS pedestrian
			FROM `project_countries` AS `pc`
				RIGHT JOIN `project_roads` ON `pc`.project_id = `project_roads`.project_id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				WHERE `project_roads`.road_id = 3
				GROUP BY `pc`.country_id, `c`.id
		) `pedestrian` ON `pedestrian`.id = `c`.id
	left join (
		select `c`.id, sum(distinct `project_products_count`.count) as kopp
			from `project_countries` as `pc`
				right join `project_products_count` on `pc`.project_id = `project_products_count`.project_id
				right join `countries` as `c` on `c`.id = `pc`.country_id
				where `project_products_count`.product_id = 4
				group by `pc`.country_id, `c`.id
		) `product1` on `product1`.id = `c`.id	
	LEFT JOIN (
		SELECT `c`.id, SUM(DISTINCT `project_products_count`.count) AS kops
			FROM `project_countries` AS `pc`
				RIGHT JOIN `project_products_count` ON `pc`.project_id = `project_products_count`.project_id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				WHERE `project_products_count`.product_id = 3
				GROUP BY `pc`.country_id, `c`.id
		) `product2` ON `product2`.id = `c`.id		
	LEFT JOIN (
		SELECT `c`.id, SUM(DISTINCT `project_products_count`.count) AS arhimed
			FROM `project_countries` AS `pc`
				RIGHT JOIN `project_products_count` ON `pc`.project_id = `project_products_count`.project_id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				WHERE `project_products_count`.product_id = 5
				GROUP BY `pc`.country_id, `c`.id
		) `product3` ON `product3`.id = `c`.id
	LEFT JOIN (
		SELECT `c`.id, SUM(DISTINCT `project_products_count`.count) AS andromeda
			FROM `project_countries` AS `pc`
				RIGHT JOIN `project_products_count` ON `pc`.project_id = `project_products_count`.project_id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				WHERE `project_products_count`.product_id = 7
				GROUP BY `pc`.country_id, `c`.id
		) `product4` ON `product4`.id = `c`.id	
	LEFT JOIN (
		SELECT `c`.id, SUM(DISTINCT contracts.amount) AS amount
			FROM `project_countries` AS `pc`
				RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
				RIGHT JOIN contracts ON `p`.id = contracts.project_id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				GROUP BY `pc`.country_id, `c`.id
		) pc2 ON pc2.id = `c`.id		");
            $rkTable = DB::select($query);

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
                'regionsTable' => $regionsTable,
                'rkTable' => $rkTable
            ]);
        }
        return redirect('/home2');

    }
}
