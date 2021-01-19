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

namespace Fangx\ESign;

use Fangx\ESign\Contract\Client;
use Fangx\ESign\Exception\ESignException;
use Psr\Http\Message\ResponseInterface;

class ESignClient implements Client
{
    protected $config = [];

    protected $client;

    protected $token;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $config['host'],
        ]);
    }

    public function getToken()
    {
        // @TODO 需要 token 持久化
        return $this->token;
    }

    public function setToken($token, $expired, $refresh)
    {
        // @TODO 需要 token 持久化
        $this->token = $token;
        return $token;
    }

    public function getAccessToken(): string
    {
        if (! $this->getToken()) {
            $response = $this->response($this->client->request('get', '/v1/oauth2/access_token', ['query' => http_build_query([
                'appId' => $this->config['app_id'],
                'secret' => $this->config['secret'],
                'grantType' => 'client_credentials',
            ])]));

            $this->setToken($response['token'], $response['expiresIn'], $response['refreshToken']);
        }

        return $this->getToken();
    }

    public function request($method, $uri, $data): array
    {
        $options = [
            'headers' => $this->getHeaders(),
        ];

        if (strtolower($method) === 'get') {
            $options['query'] = http_build_query($data);
        } else {
            if (!empty($data)){
                $options['body'] = json_encode($data);
            }
        }

        return $this->response($this->client->request($method, $uri, $options));
    }

    public function upload($url, $headers, $body)
    {
        return $this->client->request('put', $url, [
            'headers' => $headers + $this->getHeaders(),
            'body' => $body,
        ]);
    }

    protected function getHeaders()
    {
        return [
            'X-Tsign-Open-App-Id' => $this->config['app_id'],
            'Content-Type' => 'application/json; charset=UTF-8',
            'X-Tsign-Open-Token' => $this->getAccessToken(),
            'X-Tsign-Dns-App-Id' => $this->config['app_id'],
        ];
    }

    private function response(ResponseInterface $response)
    {
        $body = $response->getBody();

        $data = json_decode((string)$body, true) ?: [];

        if (($data['code'] ?? null) !== 0) {
            ESignException::touch($response,$data);
        }

        return $data['data'] ?:[];
    }
}
