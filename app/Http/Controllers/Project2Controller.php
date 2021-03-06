<?php

namespace App\Http\Controllers;

use App\Project2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Project2Controller extends Controller
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
                } elseif ($this->user->role === 'Оператор') {
                    return redirect('/home2');
                } elseif ($this->user->role === 'Бухгалтер' || $this->user->role === 'Суперпользователь' || $this->user->role === 'Администратор') {
                    return redirect('/home');
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
        return view('projects2');
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
        if(Project2::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project2  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project2 $project)
    {
        return $project;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project2  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project2 $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project2  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project2 $project)
    {
        if($project->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project2  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project2 $project)
    {
        if($project->delete()){
            return true;
        }
    }
}
