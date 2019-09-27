<?php

namespace App\Http\Controllers;

use App\CafapRegionPo;
use App\Country;
use App\CountryCode;
use App\Product;
use App\Project;
use App\Region;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::whereNull('head_id')->get();
        return view('admin-index', [
            'projects' => $projects
        ]);
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
        $countryCodes = CountryCode::all();
        return view('edit-country', [
            'country' => $country,
            'countryCodes' => $countryCodes
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
        $countryCodes = CountryCode::all();
        return view('add-country', [
            'countryCodes' => $countryCodes
        ]);
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

    public function products()
    {
        $products = Product::all();
        return view('products', [
            'products' => $products
        ]);
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        return view('edit-product', [
            'product' => $product
        ]);
    }

    public function submitProduct($id, Request $request)
    {
        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->save();
        return redirect('/products');
    }

    public function addProduct()
    {
        return view('add-product');
    }

    public function createProduct(Request $request)
    {
        $product = new Product($request->all());
        $product->save();
        return redirect('/products');
    }

    public function deleteProduct($id)
    {
        Product::destroy($id);
        return redirect('/products');
    }

    public function deleteCountry($id)
    {
        Country::destroy($id);
        return redirect('/countries');
    }

    public function deleteRegion($id)
    {
        Region::destroy($id);
        return redirect('/regions');
    }

    public function poCafap()
    {
        $poCafap = CafapRegionPo::all();
        return view('po-cafap', [
            'poCafap' => $poCafap
        ]);
    }

    public function editPoCafap($id)
    {
        $poCafap = CafapRegionPo::find($id);
        return view('edit-po-cafap', [
            'poCafap' => $poCafap
        ]);
    }

    public function submitPoCafap($id, Request $request)
    {
        $poCafap = CafapRegionPo::find($id);
        $poCafap->name = $request->get('name');
        $poCafap->save();
        return redirect('/po-cafap');
    }

    public function addPoCafap()
    {
        return view('add-po-cafap');
    }

    public function createPoCafap(Request $request)
    {
        $poCafap = new CafapRegionPo($request->all());
        $poCafap->save();
        return redirect('/po-cafap');
    }

    public function deletePoCafap($id)
    {
        CafapRegionPo::destroy($id);
        return redirect('/po-cafap');
    }
}
