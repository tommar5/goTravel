<?php
namespace App\Service\rapidapi;

use Symfony\Component\Config\Definition\Exception\Exception;

class AirlineDataResponse
{
    private $rapidHost;
    private $rapidKey;

    public function __construct($rapidHost, $rapidKey)
    {
        $this->rapidHost = $rapidHost;
        $this->rapidKey = $rapidKey;
    }

    public function getAirlineData($iata)
    {
        $curl = curl_init();

        try {
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://iata-and-icao-codes.p.rapidapi.com/airline?iata_code=" . $iata,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: " . $this->rapidHost,
                    "x-rapidapi-key: " . $this->rapidKey
                ),
            ));

            $response = curl_exec($curl);

            if ($response === false) {
                dump(curl_error($curl), curl_errno($curl));
                die();
            }

            curl_close($curl);

            dump($response);
            die();

            return $response;
        } catch (Exception $e) {
            throw new Exception(curl_error($curl), $e);
        }
    }
}