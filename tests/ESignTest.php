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

namespace Fangx\Tests;

use Fangx\ESign\Api\account;
use Fangx\ESign\Api\FileTemplate;
use Fangx\ESign\Api\IdentityVerified;
use Fangx\ESign\Contract\AccountApi;
use Fangx\ESign\Contract\Client;
use Fangx\ESign\Contract\FileTemplateApi;
use Fangx\ESign\Contract\IdentityVerifiedApi;
use Fangx\ESign\ESign;
use Fangx\ESign\ESignClient;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class ESignTest extends TestCase
{
    // 每个测试执行之前都自动执行的方法
    protected function setUp(): void
    {
        app()->singleton(Client::class, function () {
            return new ESignClient([
                'host' => 'https://smlopenapi.esign.cn',
                'app_id' => '4438777412',
                'secret' => '7c5b1cdddc0c61704d26a9882905f539',
            ]);
        });

        // 绑定 API 及其对应的实现
        app()->singleton(FileTemplateApi::class, FileTemplate::class);
        app()->singleton(AccountApi::class,account::class);
        app()->singleton(IdentityVerifiedApi::class,IdentityVerified::class);
    }

    public function testDi()
    {
        /** @var ESign $esign */
        $esign = app(ESign::class);

        $this->assertInstanceOf(FileTemplateApi::class, $esign->fileTemplateApi());
        $this->assertEquals(FileTemplate::class, get_class($esign->fileTemplateApi()));
    }

    public function testGetAccessToken()
    {
//        $client = $this->getClient();
//
//        dump($client->getAccessToken());
//
        $this->assertTrue(true);
    }

    public function testFileTemplateApi()
    {
        // 66bb0f23e79948b880ef59ed13b717ff
        // https://esignoss.esign.cn/1111564182/21092802-6611-434a-b3e2-a8fa2f1c7644/demo?Expires=1603388185&OSSAccessKeyId=STS.NUaX6C8AkGMk4GGejkLe5kzsn&Signature=A67PMGYSoTWJ2SCleTSuq36tJCE%3D&callback-var=eyJ4OmZpbGVfa2V5IjoiJGM0Y2I2MTQzMTA3ZDQ2ZWU5ZDViMzA3MGE5NDQ1NDM4JDEwODUxODYzMCRIIn0%3D%0A&callback=eyJjYWxsYmFja1VybCI6Imh0dHA6Ly80Ny45OS4yMjQuMjM1OjgwODAvZmlsZS1zeXN0ZW0vY2FsbGJhY2svYWxpb3NzIiwiY2FsbGJhY2tCb2R5IjogIntcIm1pbWVUeXBlXCI6JHttaW1lVHlwZX0sXCJzaXplXCI6ICR7c2l6ZX0sXCJidWNrZXRcIjogJHtidWNrZXR9LFwib2JqZWN0XCI6ICR7b2JqZWN0fSxcImV0YWdcIjogJHtldGFnfSxcImZpbGVfa2V5XCI6JHt4OmZpbGVfa2V5fX0iLCJjYWxsYmFja0JvZHlUeXBlIjogImFwcGxpY2F0aW9uL2pzb24ifQ%3D%3D%0A&security-token=CAIS%2BAF1q6Ft5B2yfSjIr5bUE4z31Z5K8I%2BANmH2gWo%2BQOoZhL%2FYjDz2IHtKdXRvBu8Xs%2F4wnmxX7f4YlqB6T55OSAmcNZEoaGa2E77nMeT7oMWQweEurv%2FMQBqyaXPS2MvVfJ%2BOLrf0ceusbFbpjzJ6xaCAGxypQ12iN%2B%2Fm6%2FNgdc9FHHPPD1x8CcxROxFppeIDKHLVLozNCBPxhXfKB0ca0WgVy0EHsPnvm5DNs0uH1AKjkbRM9r6ceMb0M5NeW75kSMqw0eBMca7M7TVd8RAi9t0t1%2FIVpGiY4YDAWQYLv0rda7DOltFiMkpla7MmXqlft%2BhzcgeQY0pc%2FRqAAYkr%2FMGpu7srfsGgfYMS2o5q9V1Uey2iK0xchOVdhDGAJAUaBY%2B6jWsrX8bGlNwY0jrZ%2B74MfJOkMfNkKdRZaojGFAPLgD12%2F2pEzNkpJgFwagL1CmOcC0gKMAL8SMiRyKmJq6%2FR4Skvt%2Bq9NiIx%2F9BSZ1JuqfL7lXjDkBvPxhLN
//        $eSign = app(ESign::class);
//
//        $filepath = __DIR__ . '/../test.pdf';
//
//        $upload = $eSign->fileTemplateApi()->getUploadUrl($filepath);
//
//        try {
//            $response = $eSign->fileTemplateApi()->upload($upload['uploadUrl'], $filepath);
//        } catch (\Throwable $throwable) {
//            if ($throwable instanceof RequestException) {
//                $response = $throwable->getResponse();
//            } else {
//                dd($throwable);
//            }
//        }
//
//        dump($upload, $response->getBody()->getContents());

        $this->assertTrue(true);
    }

    public function testCreatePersonAccount()
    {
//        $eSign = app(ESign::class);
//
//        //$thirdPartyUserId, $name, $idType, $idNumber, $mobile = null, $email = null
//        $personAccount = $eSign->accountApi()->createPersonAccount();
//
//        dump($personAccount);

        $this->assertTrue(true);
    }

    public function testQueryPersonByAccount()
    {
//        $eSign = app(ESign::class);
//
//        $personAccountInfo = $eSign->accountApi()->queryPersonByAccount('');
//
//        dump($personAccountInfo);

        $this->assertTrue(true);
    }

    public function testGetPersonVerifyUrl()
    {
        $eSign = app(ESign::class);

        $personUrl = $eSign->identityVerifiedApi()->getPersonIdentityAuthUrl();

        dump($personUrl);

        $this->assertTrue(true);
    }
}

