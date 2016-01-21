<?php

namespace Spatie\GoogleSearch;

use Exception;
use Spatie\GoogleSearch\Interfaces\GoogleSearchInterface;
use GuzzleHttp\Client;

class GoogleSearch implements GoogleSearchInterface
{
    protected $searchEngineId;
    protected $query;

    public function __construct($searchEngineId)
    {
        $this->searchEngineId = $searchEngineId;
    }

    /**
     * Get results from a Google Custom Search Engine.
     *
     * @param string $query
     *
     * @return array An associative array of the parsed comment, whose keys are `name`,
     *               `url` and `snippet` and some others
     *
     * @throws Exception
     */
    public function getResults($query)
    {
        $searchResults = [];

        if ($query == '') {
            return $searchResults;
        }

        if ($this->searchEngineId == '') {
            throw new \Exception('You must specify a searchEngineId');
        }

        $client = new Client();
        $result = $client->get('http://www.google.com/cse', ['query' => ['cx' => $this->searchEngineId,
                'client' => 'google-csbe',
                'num' => 20,
                'output' => 'xml_no_dtd',
                'q' => $query,
            ],
        ]);

        if ($result->getStatusCode() != 200) {
            throw new Exception('Resultcode was not ok: '.$result->getStatusCode());
        }

        $xml = simplexml_load_string($result->getBody());

        if ($xml->RES->R) {
            $i = 0;
            foreach ($xml->RES->R as $item) {
                $searchResults[$i]['name'] = (string) $item->T;
                $searchResults[$i]['url'] = (string) $item->U;
                $searchResults[$i]['snippet'] = (string) $item->S;
                $searchResults[$i]['image'] = $this->getPageMapProperty($item, 'cse_image', 'src');

                $searchResults[$i]['product']['name'] = $this->getPageMapProperty($item, 'product', 'name');
                $searchResults[$i]['product']['brand'] = $this->getPageMapProperty($item, 'product', 'brand');
                $searchResults[$i]['product']['price'] = $this->getPageMapProperty($item, 'product', 'price');
                $searchResults[$i]['product']['image'] = $this->getPageMapProperty($item, 'product', 'image');
                $searchResults[$i]['product']['identifier'] = $this->getPageMapProperty($item, 'product', 'identifier');

                $searchResults[$i]['offer']['price'] = $this->getPageMapProperty($item, 'offer', 'price');
                $searchResults[$i]['offer']['pricecurrency'] = $this->getPageMapProperty($item, 'offer', 'pricecurrency');

                ++$i;
            }
        }

        return $searchResults;
    }

    /**
     * Get a the value Pagemap property with the given name of the given type of the given item.
     *
     * @param $item
     * @param $type
     * @param $attribute
     *
     * @return string
     */
    public function getPageMapProperty($item, $type, $attribute)
    {
        $propertyArray = $item->PageMap->xpath('DataObject[@type="'.$type.'"]/Attribute[@name="'.$attribute.'"]/@value');

        if (!count($propertyArray)) {
            return '';
        }

        return (string) $propertyArray[0];
    }
}
