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
use Illuminate\Support\ServiceProvider;

class ESignServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Client::class, function () {
            return new ESignClient(config('esign', [
                'host' => 'https://openapi.esign.cn',
                'app_id' => '',
                'secret' => '',
            ]));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('esign.php'),
        ]);
    }
}
