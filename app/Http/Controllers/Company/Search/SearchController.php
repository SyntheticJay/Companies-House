<?php

namespace App\Http\Controllers\Company\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchRequest;
use Jay\CHouse\CompaniesHouse;

class SearchController extends Controller
{
    /**
     * The Companies House API client
     *
     * @var \Jay\CHouse\CompaniesHouse
     */
    public CompaniesHouse $client;

    /**
     * Construct a new SearchController instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new CompaniesHouse(env('CHOUSE_API_KEY'));
    }

    /**
     * Show the main search page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('search');
    }

    /**
     * Handle the search request
     *
     * @param   SearchRequest  $request  The request object
     *
     * @return \Illuminate\Http\RedirectResponse
     * @todo Make this better lol
     */
    public function search(SearchRequest $request)
    {
        $validated = $request->validated();
        $query     = $validated['query'];
        $results   = query($this->client, $query);

        if ($results->count() === 1) {
            return redirect()->route('company', $results->first()['company_number']);
        }

        return view('search', compact('results', 'query'));
    }
}
