<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class CompaniesHouseService
{
    /**
     * The base URL for the Companies House API.
     *
     * @var string
     */
    protected string $baseUrl;

    /**
     * The API token for the Companies House API.
     *
     * @var string
     */
    protected string $token;

    /**
     * CompaniesHouseService constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseUrl = config('services.companies-house.base_url');
        $this->token   = config('services.companies-house.api_token');
    }

    /**
     * Search the Companies House API for companies.
     *
     * @param string $query The search query.
     * @param int $itemsPerPage The number of items per page.
     * @param int $startIndex The start index.
     *
     * @return array|RequestException
     */
    public function query(
        string $query,
        int $itemsPerPage = 10,
        int $startIndex = 0
    ): array|RequestException {
        $response = $this->buildRequest()->get(
            url: '/search/companies',
            query: [
                'q' => $query,
                'items_per_page' => $itemsPerPage,
                'start_index' => $startIndex,
            ]
        );

        if ($response->failed()) {
            return $response->toException();
        }

        return $response->json()['items'];
    }

    /**
     * Get a company from the Companies House API.
     *
     * @param string $number The company number.
     *
     * @return array|RequestException
     */
    public function company(
        string $number
    ): array|RequestException {
        $response = $this->buildRequest()->get(
            url: '/company/' . $number
        );

        if ($response->failed()) {
            return $response->toException();
        }

        $json = $response->json();

        foreach ($json['links'] as $name => $link) {
            if ($name == 'self') continue;

            $json[$name] = $this->buildRequest()->get(
                url: $link
            )->json()['items'] ?? [];
        }

        return $json;
    }

    /**
     * Build a new request to the Companies House API.
     *
     * @return PendingRequest
     */
    private function buildRequest(): PendingRequest
    {
        return Http::withBasicAuth(
            username: $this->token,
            password: ''
        )->withHeaders([
            'Accept' => 'application/json',
        ])->baseUrl(
            url: $this->baseUrl
        );
    }
}
