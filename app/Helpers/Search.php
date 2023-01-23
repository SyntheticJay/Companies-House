<?php

use Jay\CHouse\CompaniesHouse;

if (!function_exists('query')) {
    /**
     * Query the Companies House API for a company by ID or name.
     *
     * @param   CompaniesHouse  $client  The Companies House API client.
     * @param   string          $query   The query to search for.
     *
     * @return \Illuminate\Support\Collection
     */
    function query(CompaniesHouse $client, string $query)
    {
        $results = collect([]);

        foreach ($client->fromCompanyID($query) as $company) {
            $results->push($company);
        }

        foreach ($client->fromCompanyName($query) as $company) {
            $results->push($company);
        }

        return $results;
    }
}
