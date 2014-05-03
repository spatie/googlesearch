<?php namespace Spatie\GoogleSearch;

use Spatie\GoogleSearch\Interfaces\GoogleSearchInterface;

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

        $url = "http://www.google.com/cse?cx=" . $this->searchEngineId . "&client=google-csbe&num=20&output=xml_no_dtd&q=" . $query;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_FAILONERROR, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1); // return into a variable
        curl_setopt($curl, CURLOPT_TIMEOUT, 3); // times out after 4s

//submit the xml request and get the response
        $result = curl_exec($curl);
        curl_close($curl);
        dd($result);

//now parse the xml with
        $xml = simplexml_load_string($result);

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