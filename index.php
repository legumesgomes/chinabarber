<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

$installing_file_exists = file_exists(__DIR__ . '/INSTALLING');

if ($installing_file_exists) {
    $required_extensions = array('bcmath', 'ctype', 'curl', 'dom', 'fileinfo', 'json', 'mbstring', 'openssl', 'pcre', 'pdo', 'tokenizer', 'xml', 'iconv');

    foreach ($required_extensions as $ext) {
        if (!extension_loaded($ext)) {
            throw new Exception('PHP extension ' . $ext . ' is not installed on your system');
        }
    }
}
    
    define('LARAVEL_START', microtime(true));
    
    /*
    |--------------------------------------------------------------------------
    | Check If Application Is Under Maintenance
    |--------------------------------------------------------------------------
    |
    | If the application is maintenance / demo mode via the "down" command we
    | will require this file so that any prerendered template can be shown
    | instead of starting the framework, which could cause an exception.
    |
    */
    
    if (file_exists(__DIR__.'/storage/framework/maintenance.php')) {
        require __DIR__.'/storage/framework/maintenance.php';
    }
    
    /*
    |--------------------------------------------------------------------------
    | Register The Auto Loader
    |--------------------------------------------------------------------------
    |
    | Composer provides a convenient, automatically generated class loader for
    | this application. We just need to utilize it! We'll simply require it
    | into the script here so we don't need to manually load our classes.
    |
    */
    
    require __DIR__.'/vendor/autoload.php';
    
    /*
    |--------------------------------------------------------------------------
    | Run The Application
    |--------------------------------------------------------------------------
    |
    | Once we have the application, we can handle the incoming request using
    | the application's HTTP kernel. Then, we will send the response back
    | to this client's browser, allowing them to enjoy our application.
    |
    */
    
    $app = require_once __DIR__.'/bootstrap/app.php';
    
    $kernel = $app->make(Kernel::class);
    
    $response = tap($kernel->handle(
        $request = Request::capture()
    ))->send();
    
    $kernel->terminate($request, $response);
    

// ---- TESTE ----
if (class_exists(\plugins\UserProfileBanner\Providers\UserProfileBannerServiceProvider::class)) {
    error_log("INDEX.PHP: UserProfileBannerServiceProvider CLASS EXISTS!");
} else {
    error_log("INDEX.PHP: UserProfileBannerServiceProvider CLASS DOES NOT EXIST!");
}
// ---- FIM TESTE ----
