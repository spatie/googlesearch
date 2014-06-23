<?php namespace Spatie\GoogleSearch;

use Spatie\GoogleSearch\Interfaces\GoogleSearchInterface;
use GuzzleHttp\Client;

class GoogleSearch implements GoogleSearchInterface {
    protected $searchEngineId;
    protected $query;

    public function __construct($searchEngineId) {
        $this->searchEngineId = $searchEngineId;
    }

    /**
     *
     * Get results from a Google Custom Search Engine
     *
     * @param string $query
     * @return array An associative array of the parsed comment, whose keys are `name`,
     *         `url` and `snippet`
     */
    public function getResults($query) {

        $searchResults = [];

        if ($query == '') {
            return $searchResults;
        }

        if ($this->searchEngineId == '') {
            throw new \Exception('You must specify a searchEngineId');
        }

        $client = new Client();
        $result = $client->get('http://www.google.com/cse', ['query' =>

            ['cx'=> $this->searchEngineId,
                'client'=> 'google-csbe',
                'num' => 20,
                'output'=> 'xml_no_dtd',
                'q'=> $query
            ]
        ]);


        if ($result->getStatusCode() != 200) {
            throw new \Exception('Resultcode was not ok: ' . $result->getStatusCode());
        }

        $xml = simplexml_load_string($result->getBody());

        if ($xml->RES->R) {
            $i=0;
            foreach ($xml->RES->R as $item) {
                $searchResults[$i]['name'] = (string)$item->T;
                $searchResults[$i]['url'] = (string)$item->U;
                $searchResults[$i]['snippet'] = (string)$item->S;
                $i++;
            }
        }

        return $searchResults;
    }
}