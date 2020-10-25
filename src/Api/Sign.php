<?php


namespace Fangx\ESign\Api;


use Fangx\ESign\Contract\Client;
use Fangx\ESign\Contract\SignApi;

class Sign implements SignApi
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 签署流程的创建
     *
     * @param $businessScene
     * @param false $autoArchive
     * @param null $noticeDeveloperUrl
     * @param int $noticeType
     * @param null $redirectUrl
     * @param int $signPlatform
     * @param int $redirectDelayTime
     * @param null $contractValidity
     * @param null $contractRemind
     * @param null $signValidity
     * @param null $initiatorAccountId
     * @param null $initiatorAuthorizedAccountId
     * @return array
     */
    public function createSignFlow($businessScene, $autoArchive = false, $noticeDeveloperUrl = null, $noticeType = 1, $redirectUrl = null, $signPlatform = 2, $redirectDelayTime = 3, $contractValidity = null, $contractRemind = null, $signValidity = null, $initiatorAccountId = null, $initiatorAuthorizedAccountId = null)
    {
        $url = "/v1/signflows";

        $body = [
            'autoArchive' => $autoArchive,
            'businessScene' => $businessScene,
            'configInfo' => [
                'noticeDeveloperUrl' => $noticeDeveloperUrl,
                'noticeType' => $noticeType,
                'redirectUrl' => $redirectUrl,
                'signPlatform' => $signPlatform,
                'redirectDelayTime' => $redirectUrl,
            ],
            'contractValidity' => $contractValidity,
            'contractRemind' => $contractRemind,
            'signValidity' => $signValidity,
            'initiatorAccountId' => $initiatorAccountId,
            'initiatorAuthorizedAccountId' => $initiatorAuthorizedAccountId
        ];

        return $this->client->request('post', $url, $body);
    }

    /**
     * 查询签署流程
     *
     * @param $flowId
     * @return array
     */
    public function querySignFlow($flowId)
    {
        $url = "/v1/signflows/{$flowId}";

        return $this->client->request('get',$url,[]);
    }

    /**
     * 签署流程开启
     * @param $flowId
     * @return array
     */
    public function startSignFlow($flowId)
    {
        $url = "/v1/signflows/{$flowId}/start";

        return $this->client->request('put',$url,[]);

    }

  public function revokeSignFlow($flowId, $operatorId = null, $revokeReason = "撤销")
  {
      $url = "/v1/signflows/{$flowId}/revoke";

      $body = [
          'operatorId' => $operatorId,
          'revokeReason' => $revokeReason,
      ];

      return $this->client->request('put',$url,$body);
  }


}