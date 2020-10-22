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
    public function getAccessToken(): string;

    public function request($method, $uri, $data): array;
}
