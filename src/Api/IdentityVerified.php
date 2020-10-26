<?php


namespace Fangx\ESign\Api;


use Fangx\ESign\Contract\Client;
use Fangx\ESign\Contract\IdentityVerifiedApi;

class IdentityVerified implements IdentityVerifiedApi
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 获取个人核身认证地址
     *
     * @param string $authType
     * @param null $contextId
     * @param null $notifyUrl
     * @param null $redirectUrl
     * @return array
     */
    public function getPersonIdentityAuthUrl($authType = "PSN_FACEAUTH_BYURL", $contextId = null, $notifyUrl = null, $redirectUrl = null)
    {
        $url = "/v2/identity/auth/web/indivAuthUrl";
        $body = [
            'authType' => $authType,
            'contextInfo' => [
                'contextId' => $contextId,
                'notifyUrl' => $notifyUrl,
                'redirectUrl' => $redirectUrl
            ]
        ];

        return $this->client->request('post',$url,$body);
    }

    /**
     * 获取企业核身认证地址
     *
     * @param string $authType
     * @param null $contextId
     * @param null $notifyUrl
     * @param null $redirectUrl
     * @return array
     */
    public function getOrganizeIdentityAuthUrl($authType = "ORG_ZM_AUTHORIZE", $contextId = null, $notifyUrl = null, $redirectUrl = null)
    {
        $url = "/v2/identity/auth/web/orgAuthUrl";

        $body = [
            'authType' => $authType,
            'contextInfo' => [
                'contextId' => $contextId,
                'notifyUrl' => $notifyUrl,
                'redirectUrl' => $redirectUrl
            ]
        ];

        return $this->client->request('post',$url,$body);
    }

    /**
     * 查询认证主流程明细
     *
     * @param $flowId
     * @return array
     */
    public function queryOutLine($flowId)
    {
        $url = "/v2/identity/auth/api/common/{$flowId}/outline";

        return $this->client->request('get',$url,[]);
    }

    public function queryIdentityDetail($flowId)
    {
        $url = "/v2/identity/auth/api/common/{$flowId}/detail";

        return $this->client->request('get',$url,[]);
    }

}