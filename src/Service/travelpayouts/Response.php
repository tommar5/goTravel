<?php
namespace App\Service\travelpayouts;

use Symfony\Component\Config\Definition\Exception\Exception;

class Response
{
    private $apiToken;

    public function __construct($apiToken)
    {
        $this->apiToken = $apiToken;
    }

    public function getCountriesDataResponse()
    {
        return $this->CurlMethod("https://api.travelpayouts.com/data/en/countries.json");
    }

    public function getCitiesDataResponse()
    {
        return $this->CurlMethod("https://api.travelpayouts.com/data/en/cities.json");
    }

    public function getAirportsDataResponse()
    {
        return $this->CurlMethod("https://api.travelpayouts.com/data/en/airports.json");
    }

    public function getAirlinesDataResponse()
    {
        return $this->CurlMethod("https://api.travelpayouts.com/data/en/airlines.json");
    }

    public function getFlightPriceResponse()
    {
        return $this->CurlMethod("https://api.travelpayouts.com/v2/prices/latest?currency=eur&origin=LT&destination=IEV&beginning_of_period=2020-05-01&period_type=month&one_way=true&page=1&limit=20&show_to_affiliates=true&sorting=price&trip_class=0");
    }

    private function CurlMethod($url)
    {
        $curl = curl_init();

        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-access-token: " . $this->apiToken
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return $response;
        } catch (Exception $e) {
            throw new Exception(curl_error($curl), $e);
        }
    }
}