<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class Home2Controller extends Controller
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
        if (auth()->user()->role === 'Оператор') {
            $projectsRealize = Project::where([['status', '=', 'Реализация'], ['head_id', '=', auth()->user()->id]])->get();
            $projectsFinished = Project::where([['status', '=', 'Завершен'], ['head_id', '=', auth()->user()->id]])->get();
            return view('home2', [
                'projectsRealization' => $projectsRealize,
                'projectsFinished' => $projectsFinished
            ]);
        }

        return redirect('/home');
    }
}
