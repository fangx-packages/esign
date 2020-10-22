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
use Fangx\ESign\Contract\FileTemplateApi;

class FileTemplate implements FileTemplateApi
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function upload($uploadUrl, $filepath)
    {
        return $this->client->upload($uploadUrl, [
            'Content-MD5' => $this->getContentMD5($filepath),
            'Content-Type' => 'application/pdf',
        ], file_get_contents($filepath));
    }

    public function getUploadUrl($filepath)
    {
        if (! file_exists($filepath)) {
            // @TODO 这里应该抛出一个异常
            return null;
        }

        return $this->client->request('post', '/v1/files/getUploadUrl', [
            'contentMd5' => $this->getContentMD5($filepath),
            'contentType' => 'application/pdf', # @TODO 文件类型应该从文件中获取
            'convert2Pdf' => false,
            'fileName' => pathinfo($filepath, PATHINFO_FILENAME) . '.' . pathinfo($filepath, PATHINFO_EXTENSION),
            'fileSize' => filesize($filepath),
        ]);
    }

    private function getContentMD5($filepath)
    {
        return base64_encode(md5_file($filepath, true));
    }
}
