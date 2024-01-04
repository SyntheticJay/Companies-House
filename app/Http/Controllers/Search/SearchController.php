<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchRequest;
use App\Services\CompaniesHouseService;
use Inertia\Inertia;

class SearchController extends Controller
{
    /**
     * SearchController constructor.
     *
     * @param CompaniesHouseService $companiesHouseService
     *
     * @return void
     */
    public function __construct(
        readonly CompaniesHouseService $companiesHouseService
    ) {}

    public function index()
    {
        return Inertia::render('Search');
    }

    public function search(SearchRequest $request)
    {
        $validated = $request->validated();
        $result    = $this->companiesHouseService->query(
            query: $validated['query']
        );

        return Inertia::render('Search', [
            'companies' => $result,
        ]);
    }
}
