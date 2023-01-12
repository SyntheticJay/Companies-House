<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\SearchRequest;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $validated = $request->validated();
        $companyID = $validated['company_id'];
    }
}
