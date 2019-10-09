<?php

namespace App\Http\Controllers;

use App\Account;
use App\File;
use App\User;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
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
                } elseif ($this->user->role === 'Оператор') {
                    return redirect('/home2');
                } elseif ($this->user->role === 'Бухгалтер') {
                    return redirect('/home');
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
    public function index(Request $request)
    {
        if (auth()->user()->role !== 'Оператор') {
            $user = new User;
            $users = $user->findUsers($request, auth()->user()->role);

            return view('accounts', [
                'users' => $users,
                'request' => $request
            ]);
        }

        return redirect('/projects');
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
        if (!empty($request) && $request->method() === 'POST') {
            $user->first_name = $request['first_name'] ?: $user->first_name;
            $user->second_name = $request['second_name'] ?: $user->second_name;
            $user->patronymic = $request['patronymic'] ?: $user->patronymic;
            $user->department = $request['department'] ?: $user->department;
            $user->role = $request['role'] ?: $user->role;
            $user->status = $request['status'] ?: $user->status;
            if ($request->file('avatar')) {
                if ($user->avatar) {
                    $fileSystem = new Filesystem();
                    $file = File::find($user->avatar);
                    $fileSystem->delete(public_path('Пользовательские файлы/Аватарки/' . $user->id . '/' . $file->file_name));
                    $file->delete();
                }

                $file = new File();
                $file->createFile($request->file('avatar'), public_path('Пользовательские файлы/Аватарки/' . $user->id . '/'), 'avatar');
                $user->avatar = $file->id;
            }

            $user->save();
            return redirect('/accounts');
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
