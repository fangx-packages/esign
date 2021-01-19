<?php


namespace Fangx\ESign\Api;


use Fangx\ESign\Contract\AccountApi;
use Fangx\ESign\Contract\Client;

class Account implements AccountApi
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 创建个人账户
     *
     * @param $thirdPartyUserId
     * @param $name
     * @param $idType
     * @param $idNumber
     * @param null $mobile
     * @param null $email
     * @return array
     */
    public function createPersonAccount($thirdPartyUserId, $mobile = null, $name = null, $idType = null, $idNumber = null, $email = null)
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

        return $this->client->request('post', $url, $body);

    }

    public function queryPersonByAccount($accountId)
    {
        $url = "/v1/accounts/{$accountId}";
        return $this->client->request('get', $url, []);
    }

    public function updatePersonByAccountId($accountId, $mobile = null, $name = null, $idType = null, $idNumber = null, $email = null)
    {
        $url = "/v1/accounts/{$accountId}";

        $body = [
            'name' => $name,
            'idType' => $idType,
            'idNumber' => $idNumber,
            'mobile' => $mobile,
            'email' => $email,
        ];

        return $this->client->request('put', $url, $body);
    }

    public function createOrganizeAccount($thirdPartyUserId, $creatorAccountId, $name = null, $idType = "CRED_ORG_USCC", $idNumber = null, $orgLegalIdNumber = null, $orgLegalName = null)
    {
        $url = "/v1/organizations/createByThirdPartyUserId";

        $body = [
            'thirdPartyUserId' => $thirdPartyUserId,
            'creator' => $creatorAccountId,
            'name' => $name,
            'idType' => $idType,
            'idNumber' => $idNumber,
            'orgLegalIdNumber' => $orgLegalIdNumber,
            'orgLegalName' => $orgLegalName,
        ];

        return $this->client->request('post', $url, $body);
    }

    public function queryOrganizeByAccount($orgId)
    {
        $url = "/v1/organizations/{$orgId}";
        return $this->client->request('get', $url, []);
    }

    public function updateOrganizeByAccountId($orgId, $name = null, $idType = null, $idNumber = null, $orgLegalIdNumber = null, $orgLegalName = null)
    {
        $url = "/v1/organizations/{$orgId}";

        $body = [
            'name' => $name,
            'idType' => $idType,
            'idNumber' => $idNumber,
            'orgLegalIdNumber' => $orgLegalIdNumber,
            'orgLegalName' => $orgLegalName,
        ];

        return $this->client->request('put', $url, $body);
    }
}