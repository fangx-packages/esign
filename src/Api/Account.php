<?php

declare(strict_types=1);

/**
 * Fangx's Packages
 * @link     https://nfangxu.com
 * @document https://pkg.nfangxu.com
 * @contact  nfangxu@gmail.com
 * @author   nfangxu
 * @license  https://pkg.nfangxu.com/license
 */

namespace Fangx\ESign\Api;

use Fangx\ESign\Contract\Client;

class Account
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 创建个人账户.
     *
     * @param $thirdPartyUserId
     * @param $name
     * @param $idType
     * @param $idNumber
     * @param null $mobile
     * @param null $email
     * @return array
     */
    public function createPersonAccount($thirdPartyUserId, $name, $idType, $idNumber, $mobile = null, $email = null)
    {
        $url = '/v1/accounts/createByThirdPartyUserId';

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

    public function createOrganizeAccount($thirdPartyUserId, $creatorId, $name, $idType, $idNumber, $orgLegalIdNumber = null, $orgLegalName = null)
    {
        $url = '/v1/organizations/createByThirdPartyUserId';

        $body = [
            'thirdPartyUserId' => $thirdPartyUserId,
            'creator' => $creatorId,
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
}
