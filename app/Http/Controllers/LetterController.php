<?php

namespace App\Http\Controllers;

use App\Email;
use App\Letter;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::all();
        return view('letters', [
            'emails' => $emails
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!empty($request)) {
            $email = new Email();
            $email->type = $request['type'];
            $email->number = $request['number'];
            $email->email_date = date('Y-m-d', strtotime($request['email_date']));
            $email->theme = $request['theme'];
            $email->status = $request['status'];
            $email->recipient = $request['recipient'];
            $email->save();
        }

        return redirect('/letters');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Letter::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Letter  $letters
     * @return \Illuminate\Http\Response
     */
    public function show(Letter $letters)
    {
        return $letters;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function edit(Letter $letter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Letter $letter)
    {
        if($letter->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Letter $letter)
    {
        if($letter->delete()){
            return true;
        }
    }
}
