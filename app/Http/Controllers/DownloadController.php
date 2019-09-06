<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        return response()->download(public_path($request->get('path')));
    }
}
