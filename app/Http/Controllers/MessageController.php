<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectMessage;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function send(Request $request)
    {
        $message = new ProjectMessage($request->all());
        $message->save();
        /** @var Project $project */
        $project = Project::find($request->get('project_id'));

        if ((int)$project->head->id !== (int)auth()->user()->id) {
            $messageBody = auth()->user()->first_name . ' ' . auth()->user()->second_name . ' написал: ' . $message->message;
            mail($project->head->email, 'В проекте ' . $project->name . ' новое сообщение', $messageBody);
        } else {
            $users = User::where('role', '<>', 'Оператор')->get();
            foreach ($users as $user) {
                $messageBody = auth()->user()->first_name . ' ' . auth()->user()->second_name . ' написал: ' . $message->message;
                mail($user->email, 'В проекте ' . $project->name . ' новое сообщение', $messageBody);
            }
        }

        return json_encode($message);
    }
}
