<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Home2Controller extends Controller
{
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
                } elseif ($this->user->role === 'Бухгалтер' || $this->user->role === 'Суперпользователь' || $this->user->role === 'Администратор') {
                    return redirect('/home');
                }
            }
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role === 'Оператор') {
            if (auth()->user()->department === 'Реализация') {
                $projectsRealize = Project::where([['status', '=', 'Реализация'], ['head_id', '=', auth()->user()->id]])->get();
                $projectsExploitation = Project::where([['status', '=', 'Эксплуатация'], ['realization_id', '=', auth()->user()->id]])->where(function ($query) {
                    $query->whereNull('head_id')->orWhere('head_id', '<>', auth()->user()->id);
                })->get();
            } else {
                $projectsRealize = Project::where([['status', '=', 'Эксплуатация'], ['head_id', '=', auth()->user()->id]])->get();
                $projectsExploitation = Project::where([['status', '=', 'Реализация'], ['head_id', '<>', auth()->user()->id], ['exploitation_id', '=', auth()->user()->id]])->get();
            }

            $projectsFinished = Project::where([['status', '=', 'Завершен'], ['head_id', '=', auth()->user()->id]])->get();

            return view('home2', [
                'projectsRealization' => $projectsRealize,
                'projectsFinished' => $projectsFinished,
                'projectsExploitation' => $projectsExploitation
            ]);
        }

        return redirect('/home');
    }
}
