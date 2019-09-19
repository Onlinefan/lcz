<?php

namespace App\Http\Controllers;

use App\ProjectCountry;
use App\Summary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $query = DB::raw("SELECT `c`.name AS 'Округ/Страна', `pc1`.quantity as 'Количество', `r2`.quantity AS 'Активных', `r3`.quantity AS 'Завершенных', `r4`.quantity as 'Приостановленных',
`r5`.quantity as 'Прочее', `r1`.quantity as 'Эксплуатация', addresses.address as 'Количество адресов', `linear_road`.linear_road as 'Лин. (тип 1)',
`crossroad`.crossroad as 'Пер. (тип 2)', `pedestrian`.pedestrian as 'Пер. (тип 3)', `product1`.kopp as 'Коперник (передвижка)', `product2`.kops AS 'Коперник (стационар)',
`product3`.vgk AS 'ВГК' FROM `countries` as `c`
	LEFT JOIN (
		SELECT `c`.id, COUNT(`p`.status) AS quantity
			FROM `project_countries` AS `pc`
				RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				GROUP BY `pc`.country_id, `c`.id
		) pc1 ON pc1.id = `c`.id	
	left join (
		SELECT `c`.id, count(`p`.status) as quantity
			FROM `project_countries` as `pc`
				right join `projects` as `p` on `pc`.project_id = `p`.id
				right join `countries` as `c` on `c`.id = `pc`.country_id
				where `p`.status = 'Эксплуатация'
				group by `pc`.country_id, `c`.id, `p`.status
		) r1 on r1.id = `c`.id
	left join (
		SELECT `c`.id, count(`p`.status) as quantity
			FROM `project_countries` as `pc`
				right join `projects` as `p` on `pc`.project_id = `p`.id
				right join `countries` as `c` on `c`.id = `pc`.country_id
				where `p`.status = 'Реализация'
				group by `pc`.country_id, `c`.id, `p`.status
		) r2 on r2.id = `c`.id
	left join (
		SELECT `c`.id, count(`p`.status) as quantity
			FROM `project_countries` as `pc`
				right join `projects` as `p` on `pc`.project_id = `p`.id
				right join `countries` as `c` on `c`.id = `pc`.country_id
				where `p`.status = 'Завершен'
				group by `pc`.country_id, `c`.id, `p`.status
		) r3 on r3.id = `c`.id
	LEFT JOIN (
		SELECT `c`.id, COUNT(`p`.status) AS quantity
			FROM `project_countries` AS `pc`
				RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				WHERE `p`.status = 'Приостановлен'
				GROUP BY `pc`.country_id, `c`.id, `p`.status
		) r4 ON r4.id = `c`.id
	LEFT JOIN (
		SELECT `c`.id, COUNT(`p`.status) AS quantity
			FROM `project_countries` AS `pc`
				RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				WHERE `p`.status = 'Прочее'
				GROUP BY `pc`.country_id, `c`.id, `p`.status
		) r5 ON r5.id = `c`.id
	LEFT JOIN (
		SELECT `c`.id, sum(distinct `project_regions`.address_count) AS address
			FROM `project_countries` AS `pc`
				RIGHT JOIN `project_regions` ON `pc`.country_id = `project_regions`.country_id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				GROUP BY `pc`.country_id, `c`.id
		) `addresses` ON `addresses`.id = `c`.id
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
		SELECT `c`.id, SUM(DISTINCT `project_products_count`.count) AS vgk
			FROM `project_countries` AS `pc`
				RIGHT JOIN `project_products_count` ON `pc`.project_id = `project_products_count`.project_id
				RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
				WHERE `project_products_count`.product_id = 8
				GROUP BY `pc`.country_id, `c`.id
		) `product3` ON `product3`.id = `c`.id			");
        $tableData = DB::select($query);
        return view('summary', [
            'tableData' => $tableData
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Summary::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function show(Summary $summary)
    {
        return $summary;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function edit(Summary $summary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Summary $summary)
    {
        if($summary->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Summary $summary)
    {
        if($summary->delete()){
            return true;
        }
    }
}
