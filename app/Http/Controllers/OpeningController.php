<?php

namespace App\Http\Controllers;

use App\Opening;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpeningController extends Controller
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
        if (auth()->user()->role === 'Оператор') {
            $projects = Project::where(['head_id' => auth()->user()->id])->get();
        } else {
            $projects = Project::all();
        }

        return view('openings', [
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
        if(Opening::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Opening  $openings
     * @return \Illuminate\Http\Response
     */
    public function show(Opening $openings)
    {
        return $openings;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function edit(Opening $opening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opening $opening)
    {
        if($opening->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opening $opening)
    {
        if($opening->delete()){
            return true;
        }
    }
}
