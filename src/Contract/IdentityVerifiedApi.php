<?php

namespace Fangx\ESign\Contract;

interface IdentityVerifiedApi
{
    public function getPersonIdentityAuthUrl($authType ="PSN_FACEAUTH_BYURL",$contextId = null,$notifyUrl = null,$redirectUrl = null);

    public function getOrganizeIdentityAuthUrl($authType = "ORG_ZM_AUTHORIZE",$contextId = null,$notifyUrl = null,$redirectUrl = null);

    public function getPersonIdentityAuthUrlByAccountId($accountId,$authType = "PSN_FACEAUTH_BYURL",$contextId = null,$notifyUrl = null,$redirectUrl = null);

    public function getOrganizeIdentityAuthUrlByAccountId($accountId,$agentAccountId,$authType = "ORG_ZM_AUTHORIZE",$contextId = null,$notifyUrl = null,$redirectUrl = null);

    public function queryOutLine($flowId);

    public function queryIdentityDetail($flowId);
}
