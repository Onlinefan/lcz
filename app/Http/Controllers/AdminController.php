<?php

namespace App\Http\Controllers;

use App\Cafap;
use App\CafapAndromedaExist;
use App\CafapCollage;
use App\CafapRegion;
use App\CafapRegionPo;
use App\Contract;
use App\Cost;
use App\CostPlan;
use App\Country;
use App\CountryCode;
use App\Document;
use App\Email;
use App\File;
use App\Income;
use App\IncomePlan;
use App\InitialData;
use App\OtherContract;
use App\Pir;
use App\Pnr;
use App\Product;
use App\Production;
use App\ProductionPlan;
use App\Project;
use App\ProjectContact;
use App\ProjectCountry;
use App\ProjectMessage;
use App\ProjectProductCount;
use App\ProjectRegion;
use App\ProjectResponsibilityArea;
use App\ProjectServiceType;
use App\ProjectStatus;
use App\Region;
use App\SmrInstallation;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $user;

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
        return view('edit-country', [
            'country' => $country,
        ]);
    }

    public function submitCountry($id, Request $request)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $country = Country::find($id);
        $country->name = $request->get('name');
        $country->color = $request->get('color');
        $country->save();
        return redirect('/countries');
    }

    public function addCountry()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        return view('add-country');
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
            'regions' => $regions,
        ]);
    }

    public function editRegion($id)
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $region = Region::find($id);
        $countries = Country::all();
        $codes = CountryCode::all();
        return view('edit-region', [
            'region' => $region,
            'countries' => $countries,
            'countryCodes' => $codes
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
        $region->code = $request->get('code');
        $region->save();
        return redirect('/regions');
    }

    public function addRegion()
    {
        if (auth()->user()->role === 'Оператор') {
            return redirect('/home2');
        }

        $countries = Country::all();
        $codes = CountryCode::all();
        return view('add-region', [
            'countries' => $countries,
            'countryCodes' => $codes
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

    public function projectsTable()
    {
        $projects = Project::all();
        return view('projects-table', [
            'projects' => $projects
        ]);
    }

    public function deleteProject($id)
    {
        $project = Project::find($id);
        $cafap = Cafap::where(['project_id' => $id])->first();
        if ($cafap) {
            if ($cafap->data_transfer_scheme) {
                File::destroy($cafap->data_transfer_scheme);
            }

            if ($cafap->location_directions) {
                File::destroy($cafap->location_directions);
            }

            if ($cafap->speed_mode) {
                File::destroy($cafap->speed_mode);
            }

            CafapAndromedaExist::where(['cafap_id' => $cafap->id])->delete();
            $collages = CafapCollage::where(['cafap_id' => $cafap->id])->get();
            foreach ($collages as $collage) {
                File::destroy($collage->file);
                $collage->delete();
            }

            CafapRegion::where(['cafap_id' => $cafap->id])->delete();
            $cafap->delete();
        }

        $contract = Contract::where(['project_id' => $project->id])->first();
        if ($contract) {
            if ($contract->project_charter) {
                File::destroy($contract->project_charter);
            }

            if ($contract->plan_chart) {
                File::destroy($contract->plan_chart);
            }

            if ($contract->lop) {
                File::destroy($contract->lop);
            }

            if ($contract->file) {
                File::destroy($contract->file);
            }

            if ($contract->technical_task) {
                File::destroy($contract->technical_task);
            }

            if ($contract->risks) {
                File::destroy($contract->risks);
            }

            if ($contract->decision_sheet) {
                File::destroy($contract->decision_sheet);
            }

            $contract->delete();
        }

        $costPlans = CostPlan::where(['project_id' => $project->id])->get();
        foreach ($costPlans as $costPlan) {
            Cost::where(['plan_id' => $costPlan])->delete();
            $costPlan->delete();
        }

        $emails = Email::where(['project_id' => $project->id])->get();
        foreach ($emails as $email) {
            if ($email->letter_file) {
                File::destroy($email->letter_file);
            }

            $email->delete();
        }

        $incomePlans = IncomePlan::where(['project_id' => $project->id])->get();
        foreach ($incomePlans as $incomePlan) {
            Income::where(['plan_id' => $incomePlan])->delete();
            $incomePlan->delete();
        }

        $otherContracts = OtherContract::where(['project_id' => $project->id])->get();
        foreach ($otherContracts as $otherContract) {
            if ($otherContract->contract) {
                File::destroy($otherContract->contract);
            }

            $otherContract->delete();
        }

        $productionPlans = ProductionPlan::where(['project_id' => $project->id])->get();
        foreach ($productionPlans as $productionPlan) {
            if ($productionPlan->preliminary_calculation_equipment) {
                File::destroy($productionPlan->preliminary_calculation_equipment);
            }

            if ($productionPlan->final_calculation_equipment) {
                File::destroy($productionPlan->final_calculation_equipment);
            }

            $productionPlan->delete();
        }

        ProjectContact::where(['project_id' => $project->id])->delete();
        ProjectCountry::where(['project_id' => $project->id])->delete();
        ProjectMessage::where(['project_id' => $project->id])->delete();
        ProjectProductCount::where(['project_id' => $project->id])->delete();
        ProjectRegion::where(['project_id' => $project->id])->delete();
        ProjectResponsibilityArea::where(['project_id' => $project->id])->delete();
        ProjectServiceType::where(['project_id' => $project->id])->delete();

        $projectStatuses = ProjectStatus::where(['project_id' => $project->id])->get();
        foreach ($projectStatuses as $projectStatus) {
            InitialData::where(['complex_id' => $projectStatus->id])->delete();
            Pir::where(['complex_id' => $projectStatus->id])->delete();
            Production::where(['complex_id' => $projectStatus->id])->delete();
            SmrInstallation::where(['complex_id' => $projectStatus->id])->delete();
            Pnr::where(['complex_id' => $projectStatus->id])->delete();
            Document::where(['complex_id' => $projectStatus->id])->delete();
            $projectStatus->delete();
        }

        $fileSystem = new Filesystem();
        $fileSystem->deleteDirectory(public_path('/Projects_files/' . $project->code));
        $project->delete();

        return redirect('/projects-table');
    }
}
