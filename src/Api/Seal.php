<?php


namespace Fangx\ESign\Api;


use Fangx\ESign\Contract\Client;
use Fangx\ESign\Contract\SealApi;

class Seal implements SealApi
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createPersonalTemplate($accountId, $color, $type, $alias = null, $height = null, $width = null)
    {
        $url = "/v1/accounts/{$accountId}/seals/personaltemplate";

        $body = [
            'alias' => $alias,
            'color' => $color,
            'type' => $type,
            'height' => $height,
            'width' => $width
        ];

        return $this->client->request('post', $url, $body);

    }

    public function createOrganizeTemplate($orgId, $color, $type, $central, $alias = null, $height = null, $width = null, $htext = null, $qtext = null)
    {
        $url = "/v1/organizations/{$orgId}/seals/officialtemplate";

        $body = [
            'alias' => $alias,
            'color' => $color,
            'type' => $type,
            'height' => $height,
            'width' => $width,
            'htext' => $height,
            'qtext' => $qtext,
            'central' => $central,
        ];

        return $this->client->request('post', $url, $body);

    }

    public function queryPersonSeals($accountId, $offset, $size)
    {
        $url = "/v1/accounts/{$accountId}/seals";

        $params = [
            'offset' => $offset,
            'size' => $size,
        ];

        return $this->client->request('get',$url,$params);
    }

    public function queryOrganizeSeals($orgId, $offset, $size)
    {
        $url = "/v1/organizations/{$orgId}/seals";

        $params = [
            'offset' => $offset,
            'size' => $size,
        ];

        return $this->client->request('get',$url,$params);
    }

    public function deletePersonSeal($accountId, $sealId)
    {
        $url = "/v1/accounts/{$accountId}/seals/{$sealId}";

        return $this->client->request('delete',$url,[]);
    }

    public function deleteOrganizeSeal($orgId, $sealId)
    {
        $url = "/v1/organizations/{$orgId}/seals/{$sealId}";

        return $this->client->request('delete',$url,[]);
    }
}