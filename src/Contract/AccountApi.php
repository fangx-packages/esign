<?php

namespace Fangx\ESign\Contract;

interface AccountApi
{
    public function createPersonAccount($thirdPartyUserId, $mobile = null, $name = null, $idType =null, $idNumber = null, $email = null);

    public function queryPersonByAccount($accountId);

    public function createOrganizeAccount($thirdPartyUserId,$creatorAccountId,$name = null,$idType ="CRED_ORG_USCC",$idNumber = null, $orgLegalIdNumber = null, $orgLegalName = null);

    public function queryOrganizeByAccount($orgId);
}
