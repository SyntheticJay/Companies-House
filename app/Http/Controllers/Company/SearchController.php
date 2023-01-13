<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\SearchRequest;
use Jay\CHouse\CompaniesHouse;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public CompaniesHouse $client;

    /**
     * Construct a new search controller instance
     *
     * @return void
     */
    public function __construct() {
        $this->client = new CompaniesHouse(env('CHOUSE_API_KEY'));
    }

    /**
     * Search for a company
     *
     * @param   SearchRequest  $request  The request object                   
     */
    public function search(SearchRequest $request)
    {
        $validated = $request->validated();
        $companyID = $validated['company_id'];
        $company   = $this->client->fromCompanyID($companyID);

        if ($company->count() == 0) {
            return redirect()->back()->with('error', 'No company found with that ID');
        }

        return view('company.index', compact('company'));
    }
}
