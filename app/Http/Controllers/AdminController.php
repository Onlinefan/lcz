<?php

namespace App\Http\Controllers;

use App\Country;
use App\Region;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin-index');
    }

    public function countries()
    {
        $countries = Country::all();
        return view('countries', [
            'countries' => $countries
        ]);
    }

    public function editCountry($id)
    {
        $country = Country::find($id);
        return view('edit-country', [
            'country' => $country
        ]);
    }

    public function submitCountry($id, Request $request)
    {
        $country = Country::find($id);
        $country->name = $request->get('name');
        $country->code = $request->get('code');
        $country->color = $request->get('color');
        $country->save();
        return redirect('/countries');
    }

    public function addCountry()
    {
        return view('add-country');
    }

    public function createCountry(Request $request)
    {
        $country = new Country($request->all());
        $country->save();
        return redirect('/countries');
    }

    public function regions()
    {
        $regions = Region::all();
        return view('regions', [
            'regions' => $regions
        ]);
    }

    public function editRegion($id)
    {
        $region = Region::find($id);
        $countries = Country::all();
        return view('edit-region', [
            'region' => $region,
            'countries' => $countries
        ]);
    }

    public function submitRegion($id, Request $request)
    {
        $region = Region::find($id);
        $region->name = $request->get('name');
        $region->country_id = $request->get('country_id');
        $region->save();
        return redirect('/regions');
    }

    public function addRegion()
    {
        $countries = Country::all();
        return view('add-region', [
            'countries' => $countries
        ]);
    }

    public function createRegion(Request $request)
    {
        $region = new Region($request->all());
        $region->save();
        return redirect('/regions');
    }
}
