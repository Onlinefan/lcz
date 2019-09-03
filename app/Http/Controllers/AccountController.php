<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (empty($request)) {
            $users = DB::table('users')->select(['first_name', 'second_name', 'patronymic', 'login', 'role', 'status', 'id'])->get();
        }
        else {
            $user = new User;
            $users = $user->findUsers($request);
        }
        return view('accounts', [
            'users' => $users,
            'request' => $request
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
        if(Account::Create($request->all())){
            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $accounts
     * @return \Illuminate\Http\Response
     */
    public function show(Account $accounts)
    {
        return $accounts;
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        if (!empty($request)) {
            $user->first_name = $request['first_name'] ?: $user->first_name;
            $user->second_name = $request['second_name'] ?: $user->second_name;
            $user->patronymic = $request['patronymic'] ?: $user->patronymic;
            $user->login = $request['login'] ?: $user->login;
            $user->role = $request['role'] ?: $user->role;
            $user->status = $request['status'] ?: $user->status;
            $user->save();
        }

        return view('account_edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        if($account->fill($request->all())->save()){
            return true;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        if($account->delete()){
            return true;
        }
    }
}
