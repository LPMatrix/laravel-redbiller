<?php

namespace LPMatrix\Redbiller;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class Redbiller
{
    /**
     * Issue Secret Key from your Redbiller Dashboard
     * @var string
     */
    protected $secretKey;
    /**
     * Instance of Client
     * @var Client
     */
    protected $client;
    /**
     *  Response from requests made to Redbiller
     * @var mixed
     */
    protected $response;
    /**
     * Redbiller API base Url
     * @var string
     */

    public function __construct()
    {
        $this->setKey();
        $this->setBaseUrl();
        $this->setRequestOptions();
    }
    /**
     * Get Base Url from Redbiller config file
     */
    public function setBaseUrl()
    {
        $this->baseUrl = Config::get('redbiller.paymentUrl');
    }
    /**
     * Get secret key from Redbiller config file
     */
    public function setKey()
    {
        $this->secretKey = Config::get('redbiller.secretKey');
    }
    /**
     * Set options for making the Client request
     */
    private function setRequestOptions()
    {
        $authBearer = $this->secretKey;
        $this->client = new Client(
            [
                'base_uri' => $this->baseUrl,
                'verify' => false,
                'headers' => [
                    'Private-Key' => $authBearer,
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json'
                ]
            ]
        );
    }

    /**
     * @param string $relativeUrl
     * @param string $method
     * @param array $body
     * @return Redbiller
     * @throws IsNullException
     */
    private function setHttpResponse($relativeUrl, $method, $body = [])
    {
        if (is_null($method)) {
            throw new IsNullException("Empty method not allowed");
        }
        $this->response = $this->client->{strtolower($method)}(
            $this->baseUrl . $relativeUrl,
            ["body" => json_encode($body)]
        );
        return $this;
    }

    /**
     * Get the whole response from a get operation
     * @return array
     */
    private function getResponse()
    {
        return json_decode($this->response->getBody(), true);
    }

}
