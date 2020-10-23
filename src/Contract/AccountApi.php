<?php

namespace Fangx\ESign\Contract;

interface AccountApi
{
    public function createPersonAccount($thirdPartyUserId, $name, $idType, $idNumber, $mobile = null, $email = null);

    public function queryPersonByAccount($accountId);

    public function createOrganizeAccount($thirdPartyUserId,$creatorAccountId,$name,$idType,$idNumber, $orgLegalIdNumber = null, $orgLegalName = null);

    public function queryOrganizeByAccount($orgId);
}
