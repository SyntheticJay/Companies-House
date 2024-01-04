<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Services\CompaniesHouseService;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * CompanyController constructor.
     *
     * @param CompaniesHouseService $companiesHouseService
     *
     * @return void
     */
    public function __construct(
        readonly CompaniesHouseService $companiesHouseService
    ) {}

    public function index(string $companyNumber)
    {
        $company = $this->companiesHouseService->company(
            number: $companyNumber
        );

        return Inertia::render('Company', [
           'company' => $company
        ]);
    }
}
