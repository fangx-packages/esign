<?php

namespace Fangx\ESign\Contract;

interface SealApi
{

    public function createPersonalTemplate($accountId,$color,$type,$alias=null,$height = null,$width = null);

    public function createOrganizeTemplate($orgId,$color,$type,$central,$alias = null,$height = null,$width= null,$htext = null,$qtext = null);

    public function queryPersonSeals($accountId,$offset,$size);

    public function queryOrganizeSeals($orgId,$offset,$size);

    public function deletePersonSeal($accountId,$sealId);

    public function deleteOrganizeSeal($orgId,$sealId);

    public function createSealByImage($accountId,$data,$transparentFlag = false,$type = "BASE64");
}
