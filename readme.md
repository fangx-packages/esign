## E签宝 SDK

### Install

    ```
    composer req fangx/esign
    ```

### Publish Config

    ```
    php artisan vendor:publish --provider=\\Fangx\\ESign\\ESignServiceProvider
    ```

### Usage

```php
<?php

namespace App\Http\Controllers;

use Fangx\ESign\ESign;

class ESignController
{
    public function index(ESign $esign)
    {
        // $esign->fileTemplate(); # 文件上传 API
        // $esign->account();
        // $esign->identityVerified();
        // $esign->seal();
        // $esign->sign();
    }
}

```
