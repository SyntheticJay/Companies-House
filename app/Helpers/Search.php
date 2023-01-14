<?php

use Jay\CHouse\CompaniesHouse;

if (!function_exists('query')) {
    function query(CompaniesHouse $client, string $query) {
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
