<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $message = new ProjectMessage($request->all());
        $message->save();

        if ((int)$message->user_id !== (int)auth()->user()->id) {
            /** @var Project $project */
            $project = Project::find($request->get('project_id'));
            $messageBody = auth()->user()->first_name . ' ' . auth()->user()->second_name . ' написал: ' . $message->message;
            \Monolog\Handler\mail($project->head->email, 'В проекте ' . $project->name . ' новое сообщение', $messageBody);
        }

        return json_encode($message);
    }
}
