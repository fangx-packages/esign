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

use Fangx\ESign\Api\FileTemplate;
use Fangx\ESign\Contract\Client;
use Fangx\ESign\Contract\FileTemplateApi;
use Illuminate\Support\ServiceProvider;

class ESignServiceProvider extends ServiceProvider
{
    public function register()
    {
        // @see https://learnku.com/docs/laravel/8.x/providers/9362
        $this->app->singleton(Client::class, function () {
            return new ESignClient(config('esign', [
                'host' => 'https://openapi.esign.cn',
                'app_id' => '',
                'secret' => '',
            ]));
        });

        // 绑定 API 及其对应的实现
        $this->app->singleton(FileTemplateApi::class, FileTemplate::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('esign.php'),
        ]);
    }
}
