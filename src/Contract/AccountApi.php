<?php

namespace Fangx\ESign\Contract;

interface AccountApi
{
    public function createPersonAccount($thirdPartyUserId, $name, $idType, $idNumber, $mobile = null, $email = null);
}
