<?php

namespace Fangx\ESign\Contract;

interface SignApi
{
    public function createSignFlow($businessScene,$autoArchive= false,$noticeDeveloperUrl = null,$noticeType = 1,$redirectUrl = null,$signPlatform = 2,$redirectDelayTime = 3,$contractValidity = null,$contractRemind = null,$signValidity = null,$initiatorAccountId = null,$initiatorAuthorizedAccountId = null);

    public function querySignFlow($flowId);

    public function startSignFlow($flowId);

    public function revokeSignFlow($flowId,$operatorId = null,$revokeReason = "撤销");
}