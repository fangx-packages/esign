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

namespace Fangx\ESign\Contract;

interface Client
{
    public function request(string $method, string $uri, array $data): array;

    public function upload(string $url, array $headers, string $body): array;

    public function config(string $key);
}
