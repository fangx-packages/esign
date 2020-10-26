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

        return $this->client->request('get', $url, []);
    }

    /**
     * 签署流程开启
     * @param $flowId
     * @return array
     */
    public function startSignFlow($flowId)
    {
        $url = "/v1/signflows/{$flowId}/start";

        return $this->client->request('put', $url, []);

    }

    /**
     * 签署流程撤销
     *
     * @param $flowId
     * @param null $operatorId
     * @param string $revokeReason
     * @return array
     */
    public function revokeSignFlow($flowId, $operatorId = null, $revokeReason = "撤销")
    {
        $url = "/v1/signflows/{$flowId}/revoke";

        $body = [
            'operatorId' => $operatorId,
            'revokeReason' => $revokeReason,
        ];

        return $this->client->request('put', $url, $body);
    }

    /**
     * 流程文档添加
     *
     * @param $flowId
     * @param $fileId
     * @param int $encryption
     * @param null $fileName
     * @param null $filePassword
     * @return array
     */
    public function addDocument($flowId, $fileId, $encryption = 0, $fileName = null, $filePassword = null)
    {
        $url = "/v1/signflows/{$flowId}/documents";

        $body = [
            'docs' => [
                'fileId' => $fileId,
                'encryption' => $encryption,
                'fileName' => $fileName,
                'filePassword' => $filePassword,
            ],
        ];

        return $this->client->request('post',$url,$body);
    }

    /**
     * 添加手动盖章签署区
     *
     * @param $flowId
     * @param $fileId
     * @param $signerAccountId
     * @param $order
     * @param int $signType
     * @param null $authorizedAccountId
     * @param null $actorIndentityType
     * @return array
     */
    public function addHandSign($flowId, $fileId, $signerAccountId, $order, $signType = 0, $authorizedAccountId = null, $actorIndentityType = null)
    {
        $url = "/v1/signflows/{$flowId}/signfields/handSign";

        $body = [
            'signfields' => [
                'fileId' => $fileId,
                'signerAccountId' => $signerAccountId,
                'authorizedAccountId' => $authorizedAccountId,
                'actorIndentityType' => $actorIndentityType,
                'order' => $order,
                'signType' => $signType
            ],
        ];

        return $this->client->request('post',$url,$body);
    }

    /**
     * 查询签署区列表
     *
     * @param $flowId
     * @param null $accountId
     * @param null $signFieldIds
     * @return array
     */
    public function querySignFields($flowId, $accountId = null, $signFieldIds = null)
    {
        $url = "/v1/signflows/{$flowId}/signfields";

        $params = [
            'accountId' => $accountId,
            'signfieldIds' => $signFieldIds,
        ];

        return $this->client->request('get',$url,$params);
    }

    /**
     * 流程签署人催签
     * @param $flowId 流程id
     * @param null $accountId 催签人账户id
     * @param null $noticeTypes 通知方式，逗号分割，1-短信，2-邮件 3-支付宝 4-钉钉，默认按照走流程设置
     * @param null $rushSignAccountId 被催签人账号id，为空表示：催签当前轮到签署但还未签署的所有签署人
     * @return array
     */
    public function rushSign($flowId, $accountId = null, $noticeTypes = null, $rushSignAccountId = null)
    {
        $url = "/v1/signflows/{$flowId}/signers/rushsign";

        $body = [
            'accountId' => $accountId,
            'noticeTypes' => $noticeTypes,
            'rushsignAccountId' => $rushSignAccountId
        ];

        return $this->client->request('put',$url,$body);
    }

    /**
     * 获取签署地址
     *
     * @param $flowId 流程id
     * @param $accountId  	签署人账号id
     * @param $organizeId 默认为空，返回的任务链接仅包含签署人本人需要签署的任务； 传入0，则返回的任务链接包含签署人“本人+所有代签机构”的签署任务；  传入指定机构id，则返回的任务链接包含签署人“本人+指定代签机构”的签署任务
     * @param int $urlType 	链接类型: 0-签署链接;1-预览链接;默认0
     * @return array
     */
    public function getExecuteUrl($flowId, $accountId, $organizeId, $urlType = 0)
    {
        $url = "/v1/signflows/{$flowId}/executeUrl";

        $params = [
            'accountId' => $accountId,
            'organizeId' => $organizeId,
            'urlType' => $urlType
        ];

        return $this->client->request('get',$url,$params);
    }

}