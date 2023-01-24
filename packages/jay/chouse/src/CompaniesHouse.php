<?php

namespace Jay\CHouse;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;

/**
 * A class to interact with the Companies House Registry API
 *
 * @author Jay <jay@entigy.co.uk>
 */
class CompaniesHouse
{
    protected const BASE_URI = 'https://api.company-information.service.gov.uk';

    private Client $client;

    /**
     * Construct a new Companies House wrapper instance
     *
     * @param   string  $key  The provided API key to query Companies House API
     *
     * @return  void
     */
    public function __construct(private string $key)
    {
        $this->key    = $key;
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'headers'  => [
                'Content-Type'  => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->key)
            ]
        ]);
    }

    /**
     * Search for a company via a company ID
     *
     * @param    string  $companyId   The company ID to query
     *
     * @return Collection
     */
    public function fromCompanyID(string $companyId): Collection
    {
        $response = null;

        try {
            $response = $this->client->get('/company/' . $companyId);
        } catch (ClientException $e) {
            $errorContent = json_decode($e->getResponse()->getBody()->getContents(), true);

            foreach ($errorContent['errors'] as $error) {
                return $error['error'] == 'company-profile-not-found' ? collect([]) : throw $e;
            }
        }

        $content = collect(json_decode($response->getBody()->getContents(), true));

        if (isset($content['links'])) {
            foreach ($content['links'] as $type => $baseURL) {
                if ($type == 'self') continue;

                $content[$type] = $this->fromURL($baseURL);
            }

            unset($content['links']);
        }

        return $content;
    }

    /**
     * Search for a company via a company name
     *
     * @param   string      $companyName  The company name to query
     *
     * @return  Collection
     */
    public function fromCompanyName(string $companyName): Collection
    {
        $response = $this->client->get('/search/companies', [
            'query' => [
                'q' => $companyName
            ]
        ]);

        $content = collect(json_decode($response->getBody()->getContents(), true));

        if ($content->count() == 0) {
            return collect([]);
        }

        $results = collect([]);

        foreach ($content['items'] as $item) {
            $results->push($this->fromCompanyID($item['company_number']));
        }

        return $results;
    }

    /**
     * Fetch data given a URL
     * 
     * @param   string  $baseURL  The URL to fetch data from
     * 
     * @return  Collection
     */
    public function fromURL(string $baseURL)
    {
        $response = $this->client->get($baseURL);
        $content  = $response->getBody()->getContents();

        return collect(json_decode($content, true));
    }
}
