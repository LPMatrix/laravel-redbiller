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

    //PAYOUT
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

    //USSD
    public static function createUSSDCode($data)
    {
        return (new self)->setHttpResponse('/1.0/collections/USSD/create', 'POST', $data)->getResponse();
    }

    public static function supportedUSSDBanks()
    {
        return (new self)->setHttpResponse('/1.0/collections/USSD/get-supported-banks', 'GET', $data)->getResponse();
    }

    public static function verifyUSSDTransaction($reference)
    {
        $data = ['reference' => $reference];
        return (new self)->setHttpResponse('/1.0/collections/USSD/payments/verify', 'POST', $data)->getResponse();
    }

    public static function getUSSDTransactions($data)
    {
        return (new self)->setHttpResponse('/1.0/collections/USSD/payments/list', 'GET', $data)->getResponse();
    }

    // BILLS
    public static function purchaseAirtime($data)
    {
        return (new self)->setHttpResponse('/1.0/bills/airtime/purchase/create', 'POST', $data)->getResponse();
    }

    public static function verifyAirtimePurchase($data)
    {
        return (new self)->setHttpResponse('/1.0/bills/airtime/purchase/status', 'POST', $data)->getResponse();
    }

    public static function purchaseData($data)
    {
        return (new self)->setHttpResponse('/1.0/bills/data/plans/purchase/create', 'POST', $data)->getResponse();
    }

    public static function dataPlans($data)
    {
        return (new self)->setHttpResponse('/1.0/bills/data/plans/list', 'POST', $data)->getResponse();
    }

    public static function verifyDataPurchase($data)
    {
        return (new self)->setHttpResponse('/1.0/bills/data/plans/purchase/status', 'POST', $data)->getResponse();
    }

    public static function creditBettingAccount($data)
    {
        return (new self)->setHttpResponse('/1.4/bills/betting/account/payment/create', 'POST', $data)->getResponse();
    }

    public static function verifyBettingAccountCredit($data)
    {
        return (new self)->setHttpResponse('/1.4/bills/betting/account/payment/status', 'POST', $data)->getResponse();
    }

    public static function bettingProviders()
    {
        return (new self)->setHttpResponse('/1.4/bills/betting/providers/list', 'GET')->getResponse();
    }

    public static function purchaseCablePlan($data)
    {
        return (new self)->setHttpResponse('/1.0/bills/cable/plans/purchase/create', 'POST', $data)->getResponse();
    }

    public static function cablePlans($data)
    {
        return (new self)->setHttpResponse('/1.0/bills/cable/plans/list', 'POST', $data)->getResponse();
    }

    public static function verifyCablePlanPurchase($data)
    {
        return (new self)->setHttpResponse('/1.0/bills/cable/plans/purchase/status', 'POST', $data)->getResponse();
    }

    public static function purchaseDisco($data)
    {
        return (new self)->setHttpResponse('/1.0/bills/disco/purchase/create', 'POST', $data)->getResponse();
    }

    public static function verifyDiscoPurchase($data)
    {
        return (new self)->setHttpResponse('/1.0/bills/disco/purchase/status', 'POST', $data)->getResponse();
    }
}
