<?php


namespace Fangx\ESign\Api;


use Fangx\ESign\Contract\AccountApi;

class Account implements AccountApi
{
    protected $client;

    public function __construct()
    {
    }

    public function createPersonAccount($thirdPartyUserId, $name, $idType, $idNumber, $mobile = null, $email = null)
    {
        $url = "/v1/accounts/createByThirdPartyUserId";

        $body = [
            'thirdPartyUserId' => $thirdPartyUserId,
            'name' => $name,
            'idType' => $idType,
            'idNumber' => $idNumber,
            'mobile' => $mobile,
            'email' => $email,
        ];

    }
}