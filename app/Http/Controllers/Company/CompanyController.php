<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jay\CHouse\CompaniesHouse;

class CompanyController extends Controller
{
    /**
     * The Companies House API client
     *
     * @var \Jay\CHouse\CompaniesHouse
     */
    public CompaniesHouse $client;

    /**
     * Construct a new CompanyController instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new CompaniesHouse(env('CHOUSE_API_KEY'));
    }

    /**
     * Show the company page
     *
     * @param   Request  $request    The request object
     * @param   string   $companyId  The company ID
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, string $companyId)
    {
        $company = $this->client->fromCompanyID($companyId);

        return view('company.index', compact('company'));
    }

    /**
     * Show the company officers page
     *
     * @param   Request  $request      The request object
     * @param   string   $companyId    The company ID
     *
     * @return \Illuminate\View\View
     */
    public function officers(Request $request, string $companyId)
    {
        $company  = $this->client->fromCompanyID($companyId);
        $officers = collect($company->get('officers')['items'])->map(function ($officer) {
            return collect($officer);
        });;

        return view('company.officers', compact('company', 'officers'));
    }

    public function previousNames(Request $request, string $companyId) {
        $company       = $this->client->fromCompanyID($companyId);
        $previousNames = collect($company->get('previous_company_names'))->map(function ($officer) {
            return collect($officer);
        });

        return view('company.previous-names', compact('company', 'previousNames'));
    }
}
