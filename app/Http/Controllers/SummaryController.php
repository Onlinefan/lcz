<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectCountry;
use App\Summary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SummaryController extends Controller
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

                if ($this->user->role === 'Секретарь') {
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
        if (auth()->user()->role === 'Оператор') {
            $projects = Project::where(['head_id' => auth()->user()->id])->get();
        } else {
            $projects = Project::all();
        }

        return view('summary', [
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

    public function getMap()
    {
        $codeResults = DB::select(DB::raw('SELECT regions.code, pc1.quantity FROM regions
            LEFT JOIN (
		        SELECT `c`.id, SUM(`pc`.count) AS quantity
			    FROM `project_products_count` AS `pc`
                    RIGHT JOIN `regions` AS `c` ON `c`.id = `pc`.region_id
                    GROUP BY `pc`.region_id, `c`.id
		    ) pc1 ON pc1.id = regions.id
		    where regions.code IS NOT NULL'));

        $mapData = [];
        foreach ($codeResults as $result) {
            $mapData[$result->code] = (int)$result->quantity;
        }

        return json_encode($mapData);
    }

    public function getMonthDynamic()
    {
        $dateMonth1 = date('Y-m', strtotime('-5 months'));
        $dateMonth2 = date('Y-m', strtotime('-4 months'));
        $dateMonth3 = date('Y-m', strtotime('-3 months'));
        $dateMonth4 = date('Y-m', strtotime('-2 months'));
        $dateMonth5 = date('Y-m', strtotime('-1 months'));
        $dateMonth6 = date('Y-m', strtotime('now'));
        $queryResult = DB::select(DB::raw("SELECT countries.name, countries.color, pc1.quantity AS `$dateMonth1`, pc2.quantity AS `$dateMonth2`, pc3.quantity AS `$dateMonth3`,
            pc4.quantity AS `$dateMonth4`, pc5.quantity AS `$dateMonth5`, pc6.quantity AS `$dateMonth6` FROM countries
            LEFT JOIN (
		        SELECT `c`.id, SUM(`pc`.amount) AS quantity
			    FROM `project_countries` AS `pc`
                    RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
                    RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
                    RIGHT JOIN `contracts` ON contracts.project_id = `p`.id
                    WHERE contracts.created_at LIKE '%$dateMonth1%'
                    GROUP BY `pc`.country_id, `c`.id
		    ) pc1 ON pc1.id = countries.id
		    LEFT JOIN (
		        SELECT `c`.id, SUM(`pc`.amount) AS quantity
			    FROM `project_countries` AS `pc`
                    RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
                    RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
                    RIGHT JOIN `contracts` ON contracts.project_id = `p`.id
                    WHERE contracts.created_at LIKE '$dateMonth2%'
                    GROUP BY `pc`.country_id, `c`.id
		    ) pc2 ON pc2.id = countries.id
		    LEFT JOIN (
		        SELECT `c`.id, SUM(`pc`.amount) AS quantity
			    FROM `project_countries` AS `pc`
                    RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
                    RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
                    RIGHT JOIN `contracts` ON contracts.project_id = `p`.id
                    WHERE contracts.created_at LIKE '%$dateMonth3%'
                    GROUP BY `pc`.country_id, `c`.id
		    ) pc3 ON pc3.id = countries.id
		    LEFT JOIN (
		        SELECT `c`.id, SUM(`pc`.amount) AS quantity
			    FROM `project_countries` AS `pc`
                    RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
                    RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
                    RIGHT JOIN `contracts` ON contracts.project_id = `p`.id
                    WHERE contracts.created_at LIKE '%$dateMonth4%'
                    GROUP BY `pc`.country_id, `c`.id
		    ) pc4 ON pc4.id = countries.id
		    LEFT JOIN (
		        SELECT `c`.id, SUM(`pc`.amount) AS quantity
			    FROM `project_countries` AS `pc`
                    RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
                    RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
                    RIGHT JOIN `contracts` ON contracts.project_id = `p`.id
                    WHERE contracts.created_at LIKE '%$dateMonth5%'
                    GROUP BY `pc`.country_id, `c`.id
		    ) pc5 ON pc5.id = countries.id
		    LEFT JOIN (
		        SELECT `c`.id, SUM(`pc`.amount) AS quantity
			    FROM `project_countries` AS `pc`
                    RIGHT JOIN `projects` AS `p` ON `pc`.project_id = `p`.id
                    RIGHT JOIN `countries` AS `c` ON `c`.id = `pc`.country_id
                    RIGHT JOIN `contracts` ON contracts.project_id = `p`.id
                    WHERE contracts.created_at LIKE '%$dateMonth6%'
                    GROUP BY `pc`.country_id, `c`.id
		    ) pc6 ON pc6.id = countries.id"));

       return json_encode([
           'data' => $queryResult,
           'keys' => [$dateMonth1, $dateMonth2, $dateMonth3, $dateMonth4, $dateMonth5, $dateMonth6]
       ]);
    }
}
