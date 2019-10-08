<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ProjectContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
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
        $contacts = Contact::all();
        return view('contacts', [
            'contacts' => $contacts
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
        if(Contact::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contacts
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contacts)
    {
        return $contacts;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->role === 'Бухгалтер') {
            return redirect('/contacts');
        }

        $contact = Contact::find($id);
        return view('edit-contact', [
            'contact' => $contact
        ]);
    }

    public function submit($id, Request $request)
    {
        $contact = Contact::find($id);
        $contact->fio = $request->get('fio');
        $contact->position = $request->get('position');
        $contact->mobile_number = $request->get('mobile_number');
        $contact->work_number = $request->get('work_number');
        $contact->email = $request->get('email');
        $contact->address = $request->get('address');
        $contact->company = $request->get('company');
        $contact->inn = $request->get('inn');
        $contact->save();

        return redirect('/contacts');
    }

    public function delete($id)
    {
        Contact::destroy($id);
        ProjectContact::where(['contact_id' => $id])->delete();
        return redirect('/contacts');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        if($contact->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if($contact->delete()){
            return true;
        }
    }
}
