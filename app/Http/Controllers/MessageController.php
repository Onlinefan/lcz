<?php

namespace App\Http\Controllers;

use App\ProjectMessage;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $message = new ProjectMessage($request->all());
        $message->save();
        return json_encode($message);
    }
}
