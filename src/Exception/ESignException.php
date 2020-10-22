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

namespace Fangx\ESign\Exception;

use Psr\Http\Message\ResponseInterface;

class ESignException extends \Exception
{
    protected $response;

    public function __construct(ResponseInterface $response)
    {
        parent::__construct('ESign error', 0);

        $this->response = $response;
    }

    public static function touch(ResponseInterface $response)
    {
        throw new static($response);
    }

    public function getResponse()
    {
        return $this->response;
    }
}
