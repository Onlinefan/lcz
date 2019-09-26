<?php

namespace App\Http\Controllers;

use App\Email;
use App\File;
use App\Letter;
use Illuminate\Filesystem\Filesystem;
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

            if ($request->file('letter_file')) {
                $file = new File();
                $file->createFile($request->file('letter_file'), public_path('/Mails/' . $email->status . '/' . $email->id . '/'), 'id'.uniqid());
                $email->letter_file = $file->id;
                $email->save();
            }
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

    public function edit($id)
    {
        $letter = Email::find($id);

        return view('edit-letter', [
            'letter' => $letter
        ]);
    }

    public function editSubmit(Request $request)
    {
        $letter = Email::find($request->get('id'));
        $letter->type = $request['type'] ?: $letter->type;
        $letter->number = $request['number'] ?: $letter->number;
        $letter->email_date = date('Y-m-d', strtotime($request['email_date'])) ?: $letter->email_date;
        $letter->theme = $request['theme'] ?: $letter->theme;
        $letter->status = $request['status'] ?: $letter->status;
        $letter->recipient = $request['recipient'] ?: $letter->recipient;

        if ($request->file('letter_file')) {
            if (isset($letter->letterFile)) {
                $oldFile = File::find($letter->letter_file);
                $fileSystem = new Filesystem();
                $fileSystem->delete(public_path('/Mails/' . $letter->status . '/' . $letter->id . '/' . $oldFile->file_name));
                $oldFile->delete();
            }
            $file = new File();
            $file->createFile($request->file('letter_file'), public_path('/Mails/' . $letter->status . '/' . $letter->id . '/'), 'id'.uniqid());
            $letter->letter_file = $file->id;
        }

        $letter->save();
        return redirect('/letters');
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
