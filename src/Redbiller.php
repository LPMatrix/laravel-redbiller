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

    public static function initiateTransaction($data)
    {
        return (new self)->setHttpResponse('/1.0/payout/bank-transfer/create', 'POST', $data)->getResponse();
    }

    public static function retryTransaction($data)
    {
        return (new self)->setHttpResponse('/1.0/payout/bank-transfer/retry', 'POST', $data)->getResponse();
    }

    public static function suggestBanks($account_no)
    {
        $data = ['account_no' => $account_no];
        return (new self)->setHttpResponse('/1.0/payout/bank-transfer/banks/suggest', 'POST', $data)->getResponse();
    }

    public static function getTransactions($data)
    {
        return (new self)->setHttpResponse('/1.0/payout/bank-transfer/bank-transfer/list', 'POST', $data)->getResponse();
    }

    public static function getRetriedTrail($reference)
    {
        $data = ['reference' => $reference];
        return (new self)->setHttpResponse('/1.0/payout/bank-transfer/get-retried-trail', 'GET', $data)->getResponse();
    }

    public static function verifyTransaction($reference)
    {
        $data = ['reference' => $reference];
        return (new self)->setHttpResponse('/1.0/payout/bank-transfer/banks/status', 'POST', $data)->getResponse();
    }

}
