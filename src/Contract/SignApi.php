<?php

namespace Fangx\ESign\Contract;

interface SignApi
{
    public function createSignFlow($businessScene,$autoArchive= false,$noticeDeveloperUrl = null,$noticeType = 1,$redirectUrl = null,$signPlatform = 2,$redirectDelayTime = 3,$contractValidity = null,$contractRemind = null,$signValidity = null,$initiatorAccountId = null,$initiatorAuthorizedAccountId = null);

    public function querySignFlow($flowId);

    public function startSignFlow($flowId);

    public function revokeSignFlow($flowId,$operatorId = null,$revokeReason = "撤销");

    public function addDocument($flowId,$fileId,$encryption = 0, $fileName = null,$filePassword = null);

    public function addHandSign($flowId,$fileId,$signerAccountId,$order,$signType = 0,$authorizedAccountId = null,$actorIndentityType = null);

    public function querySignFields($flowId,$accountId = null,$signFieldIds = null);

    public function rushSign($flowId, $accountId = null,$noticeTypes = null,$rushSignAccountId = null);

    public function getExecuteUrl($flowId,$accountId,$organizeId,$urlType = 0);

}