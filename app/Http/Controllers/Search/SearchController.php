<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use JustSteveKing\CompaniesHouseLaravel\Client as CompaniesHouseClient;

class SearchController extends Controller
{
    public function index()
    {
        return Inertia::render('Search');
    }

    public function search(SearchRequest $request)
    {
        $validated = $request->validated();
        $result    = collect(CompaniesHouseClient::make()->searchCompany($validated['query']));

        return Inertia::render('Search', [
            'companies' => $result,
        ]);
    }
}
