<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return response()->download(public_path($request->get('path')));
    }
}
