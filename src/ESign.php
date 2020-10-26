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

use Fangx\ESign\Api\AccessToken;
use Fangx\ESign\Api\Account;
use Fangx\ESign\Api\FileTemplate;
use Fangx\ESign\Api\IdentityVerified;
use Fangx\ESign\Api\Seal;
use Fangx\ESign\Api\Sign;
use Fangx\ESign\Contract\Client;
use Fangx\ESign\Exception\ESignException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ESign.
 *
 * @method AccessToken accessToken()
 * @method Account account()
 * @method FileTemplate fileTemplate()
 * @method IdentityVerified identityVerified()
 * @method Seal seal()
 * @method Sign sign()
 */
class ESign implements Client
{
    protected $config = [];

    protected $client;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->config('host'),
        ]);
    }

    public function __call($name, $arguments)
    {
        if (class_exists($classname = '\\Fangx\\ESign\\Api\\' . ucfirst($name))) {
            // 直接从 Laravel 容器中获取这个对象, 容器自动回实例化, 并实现对应的依赖注入
            return new $classname($this);
        }

        throw new \Exception(sprintf('Call to undefined method [%s]', $name));
    }

    public function request(string $method, string $uri, array $data): array
    {
        $options = [
            'headers' => $this->getHeaders(),
        ];

        if (strtolower($method) === 'get') {
            $options['query'] = http_build_query($data);
        } else {
            $options['body'] = json_encode($data);
        }

        return $this->response($this->client->request($method, $uri, $options));
    }

    public function upload(string $url, array $headers, string $body): array
    {
        return $this->response($this->client->request('put', $url, [
            'headers' => $headers + $this->getHeaders(),
            'body' => $body,
        ]), false);
    }

    public function config(string $key)
    {
        return $this->config[$key] ?? null;
    }

    protected function getHeaders()
    {
        return [
            'X-Tsign-Open-App-Id' => $this->config['app_id'],
            'Content-Type' => 'application/json; charset=UTF-8',
            'X-Tsign-Open-Token' => $this->accessToken()->getAccessToken(),
        ];
    }

    private function response(ResponseInterface $response, $warp = true)
    {
        $data = json_decode($response->getBody()->getContents(), true) ?: [];

        if ($warp && ($data['code'] ?? null) !== 0) {
            ESignException::touch($response);
        }

        return $warp ? $data['data'] : $data;
    }
}
