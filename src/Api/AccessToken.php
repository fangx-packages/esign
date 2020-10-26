<?php

declare(strict_types=1);

/**
 * Fangx's Packages
 * @link     https://nfangxu.com
 * @document https://pkg.nfangxu.com
 * @contact  nfangxu@gmail.com
 * @author   nfangxu
 * @license  https://pkg.nfangxu.com/license
 */

namespace Fangx\ESign\Api;

use Fangx\ESign\Contract\Client;
use Fangx\ESign\Exception\ESignException;

class AccessToken
{
    protected $client;

    protected $gzClient;

    protected $token;

    public function __construct(Client $client)
    {
        $this->gzClient = new \GuzzleHttp\Client([
            'base_uri' => $client->config('host'),
        ]);
        $this->client = $client;
    }

    public function getAccessToken()
    {
        if (! $this->token) {
            $response = $this->gzClient->request('get', '/v1/oauth2/access_token', [
                'query' => http_build_query([
                    'appId' => $this->client->config('app_id'),
                    'secret' => $this->client->config('secret'),
                    'grantType' => 'client_credentials',
                ]),
            ]);

            $data = json_decode($response->getBody()->getContents(), true) ?: [];

            if (($data['code'] ?? null) !== 0) {
                ESignException::touch($response);
            }

            $this->token = $data['token'];
        }

        return $this->token;
    }
}
