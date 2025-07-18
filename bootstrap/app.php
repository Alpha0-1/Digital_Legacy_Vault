<?php

/**
 * Laravel - The PHP Framework for Web Artisans
 *
 * @package  legacy-vault
 * @author   Digital Legacy Vault Team
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it so we can dynamically load our
| classes as needed without any manual effort.
|
*/

require __DIR__.'/../vendor/autoload.php';

$env = (new Laravel\Env\Loader(__DIR__.'/../'))->load();

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using the
| application's HTTP kernel and send the associated response back to
| the client's browser.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
