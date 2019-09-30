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
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $projects = Project::whereNull('head_id')->get();
        return view('admin-index', [
            'projects' => $projects
        ]);
    }

    public function countries()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $countries = Country::all();
        return view('countries', [
            'countries' => $countries
        ]);
    }

    public function editCountry($id)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $country = Country::find($id);
        $countryCodes = CountryCode::all();
        return view('edit-country', [
            'country' => $country,
            'countryCodes' => $countryCodes
        ]);
    }

    public function submitCountry($id, Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $country = Country::find($id);
        $country->name = $request->get('name');
        $country->code = $request->get('code');
        $country->color = $request->get('color');
        $country->save();
        return redirect('/countries');
    }

    public function addCountry()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $countryCodes = CountryCode::all();
        return view('add-country', [
            'countryCodes' => $countryCodes
        ]);
    }

    public function createCountry(Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $country = new Country($request->all());
        $country->save();
        return redirect('/countries');
    }

    public function regions()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $regions = Region::all();
        return view('regions', [
            'regions' => $regions
        ]);
    }

    public function editRegion($id)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $region = Region::find($id);
        $countries = Country::all();
        return view('edit-region', [
            'region' => $region,
            'countries' => $countries
        ]);
    }

    public function submitRegion($id, Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $region = Region::find($id);
        $region->name = $request->get('name');
        $region->country_id = $request->get('country_id');
        $region->save();
        return redirect('/regions');
    }

    public function addRegion()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $countries = Country::all();
        return view('add-region', [
            'countries' => $countries
        ]);
    }

    public function createRegion(Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $region = new Region($request->all());
        $region->save();
        return redirect('/regions');
    }

    public function products()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $products = Product::all();
        return view('products', [
            'products' => $products
        ]);
    }

    public function editProduct($id)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $product = Product::find($id);
        return view('edit-product', [
            'product' => $product
        ]);
    }

    public function submitProduct($id, Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->save();
        return redirect('/products');
    }

    public function addProduct()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        return view('add-product');
    }

    public function createProduct(Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $product = new Product($request->all());
        $product->save();
        return redirect('/products');
    }

    public function deleteProduct($id)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        Product::destroy($id);
        return redirect('/products');
    }

    public function deleteCountry($id)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        Country::destroy($id);
        return redirect('/countries');
    }

    public function deleteRegion($id)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        Region::destroy($id);
        return redirect('/regions');
    }

    public function poCafap()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $poCafap = CafapRegionPo::all();
        return view('po-cafap', [
            'poCafap' => $poCafap
        ]);
    }

    public function editPoCafap($id)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $poCafap = CafapRegionPo::find($id);
        return view('edit-po-cafap', [
            'poCafap' => $poCafap
        ]);
    }

    public function submitPoCafap($id, Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $poCafap = CafapRegionPo::find($id);
        $poCafap->name = $request->get('name');
        $poCafap->save();
        return redirect('/po-cafap');
    }

    public function addPoCafap()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        return view('add-po-cafap');
    }

    public function createPoCafap(Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $poCafap = new CafapRegionPo($request->all());
        $poCafap->save();
        return redirect('/po-cafap');
    }

    public function deletePoCafap($id)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        CafapRegionPo::destroy($id);
        return redirect('/po-cafap');
    }
}
