<?php

namespace App\Http\Controllers;

use App\Project;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        $tableHead = [];
        $tableBody = [];
        $maxCountReal = 0;
        $maxCountExp = 0;
        $maxCountFin = 0;
        foreach($projects as $project) {
            if ($project->status === 'Реализация') {
                $tableHead['realization'][$project->head_id] = $project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic;
                $tableBody['realization'][$project->head_id][] = $project->name;
            } else if ($project->status === 'Эксплуатация') {
                $tableHead['exploitation'][$project->head_id] = $project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic;
                $tableBody['exploitation'][$project->head_id][] = $project->name;
            } else {
                $tableHead['finished'][$project->head_id] = $project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic;
                $tableBody['finished'][$project->head_id][] = $project->name;
            }
        }

        if (isset($tableBody['realization'])) {
            foreach ($tableBody['realization'] as $head) {
                if (count($head) > $maxCountReal) {
                    $maxCountReal = count($head);
                }
            }
        }

        if (isset($tableBody['exploitation'])) {
            foreach ($tableBody['exploitation'] as $head) {
                if (count($head) > $maxCountExp) {
                    $maxCountExp = count($head);
                }
            }
        }

        if (isset($tableBody['finished'])) {
            foreach ($tableBody['finished'] as $head) {
                if (count($head) > $maxCountFin) {
                    $maxCountFin = count($head);
                }
            }
        }

        return view('statuses', [
            'tableHead' => $tableHead,
            'tableBody' => $tableBody,
            'maxCountReal' => $maxCountReal,
            'maxCountExp' => $maxCountExp,
            'maxCountFin' => $maxCountFin
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
        if(Status::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status  $statuses
     * @return \Illuminate\Http\Response
     */
    public function show(Status $statuses)
    {
        return $statuses;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        if($status->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        if($status->delete()){
            return true;
        }
    }
}
