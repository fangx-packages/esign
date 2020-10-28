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

use Fangx\ESign\Contract\AccountApi;
use Fangx\ESign\Contract\Client;
use Fangx\ESign\Contract\FileTemplateApi;
use Fangx\ESign\Contract\IdentityVerifiedApi;
use Fangx\ESign\Contract\SealApi;
use Fangx\ESign\Contract\SignApi;

/**
 * Class ESign.
 *
 * @method FileTemplateApi fileTemplate()
 * @method AccountApi account()
 * @method IdentityVerifiedApi identityVerified()
 * @method SealApi seal()
 * @method SignApi sign()
 */
class ESign
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __call($name, $arguments)
    {
//        if (class_exists($classname = '\\Fangx\\ESign\\Contract\\' . ucfirst($name))) {
        if (interface_exists($classname = 'Fangx\\ESign\\Contract\\' . ucfirst($name))) {
            // 直接从 Laravel 容器中获取这个对象, 容器自动回实例化, 并实现对应的依赖注入
//            return new $classname($this->client);
            return app($classname);
        }

        throw new \Exception(sprintf('Call to undefined method [%s]', $name));
    }
}
