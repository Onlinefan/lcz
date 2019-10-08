<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectMessage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
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
                } elseif ($this->user->role === 'Бухгалтер') {
                    return redirect('/home');
                }
            }
            return $next($request);
        });
    }

    public function send(Request $request)
    {
        $message = new ProjectMessage($request->all());
        $message->save();
        /** @var Project $project */
        $project = Project::find($request->get('project_id'));

        if ((int)$project->head_id !== (int)auth()->user()->id) {
            $messageBody = auth()->user()->first_name . ' ' . auth()->user()->second_name . ' написал: ' . $message->message;
            mail($project->head->email, 'В проекте ' . $project->name . ' новое сообщение', $messageBody);
        } else {
            $users = User::whereNotIn('role', ['Оператор', 'Производство', 'Бухгалтер'])->get();
            foreach ($users as $user) {
                $messageBody = auth()->user()->first_name . ' ' . auth()->user()->second_name . ' написал: ' . $message->message;
                mail($user->email, 'В проекте ' . $project->name . ' новое сообщение', $messageBody);
            }
        }

        return json_encode($message);
    }
}
