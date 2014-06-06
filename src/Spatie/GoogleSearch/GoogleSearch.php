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
        define("DEBUG", \Config::get('app.debug') );

        $searchResults = array();

        if ($query == '') {
            return $searchResults;
        }

        //check if curl is installed on the server
        if ( !function_exists('curl_init') )
            throw new \Exception('Sorry cURL is not installed!');

        $url = "http://www.google.com/cse?cx=" . $this->searchEngineId . "&client=google-csbe&num=20&output=xml_no_dtd&q=" . urlencode($query);

        $curl = curl_init();
        //check if curl was succesfully initialized
        if (DEBUG && FALSE === $curl)
            throw new \Exception('failed to initialize');

        //set curl options
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_FAILONERROR, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1); // return into a variable
        curl_setopt($curl, CURLOPT_TIMEOUT, 3); // times out after 4s

        if(DEBUG == true) {
            curl_setopt($curl, CURLOPT_HEADER, 1);
            curl_setopt($curl, CURLINFO_HEADER_OUT, 1);
        }

        //submit the xml request and get the response
        $result = curl_exec($curl);
        if(! $result) {
            //get and log the error details
            $error_arr['error'] = curl_error($curl);
            if(DEBUG) $error_arr['details'] = curl_getinfo($curl, CURLINFO_HEADER_OUT);
            \Log::error('GoogleSearch cURL error', $error_arr );

            //throw exception
            if(DEBUG) 
                throw new \Exception(curl_error($curl));
            else 
                throw new \Exception('could not get results');
        }
        curl_close($curl);

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