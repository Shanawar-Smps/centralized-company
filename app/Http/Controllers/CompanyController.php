<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompanySearchService;
use App\Models\SG\Company as SgCompany;
use App\Models\MX\Company as MxCompany;
use App\Models\PH\Company as PhCompany;
use App\Models\MY\Company as MyCompany;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function search(Request $request, CompanySearchService $service)
    {
        $results = [];
        if ($request->has('q')) {
            $results = $service->search($request->q);
        }

        return view('dashboard', compact('results'));
    }
    public function show($country, $id)
    {
        $company = null;
        $reports = [];

        switch ($country) {
            case 'SG':
                $company = SgCompany::findOrFail($id);

                $reports = DB::connection('sg')
                    ->table('reports')
                    ->select('id', 'name', 'amount as price')
                    ->get();
                break;

            case 'MX':
                $company = MxCompany::findOrFail($id);
                // reports depend on state_id
                $reports = DB::connection('mx')
                    ->table('report_state')
                    ->join('reports', 'reports.id', '=', 'report_state.report_id')
                    ->where('report_state.state_id', $company->state_id)
                    ->select('reports.name', 'report_state.amount as price')
                    ->get();
                break;

            case 'PH':
                $company = PhCompany::findOrFail($id);
                // group reports by type, multiple periods
                $reports = DB::connection('ph')
                    ->table('reports')
                    ->join('report_prices', 'report_prices.id', '=', 'reports.report_price_id')
                    ->join('report_types', 'report_types.id', '=', 'report_prices.report_type_id')
                    ->where('reports.company_id', $company->id)
                    ->select(
                        'report_types.name as type',
                        'report_types.price',
                        'reports.period_date'
                    )
                    ->get()
                    ->groupBy('type');
                break;

            case 'MY':
                $company = MyCompany::findOrFail($id);
                $reports = DB::connection('my')
                    ->table('reports')
                    ->where('company_type_id', $company->company_type_id)
                    ->where('status', '1')
                    ->select('name', 'price')
                    ->get();
                break;
        }

        return view('companies.show', compact('company', 'reports', 'country'));
    }
}
